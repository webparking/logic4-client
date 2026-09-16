<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

use cebe\openapi\Reader;
use cebe\openapi\spec\Operation;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use Webmozart\Assert\Assert;
use Webparking\Logic4Client\Enums\PaginateType;

final class Generator
{
    public const string GENERATED_MAJOR_VERSION = '3';

    public string $localApi = __DIR__.'/../logic4-api-%s-%s.json';

    public string $baseDirectory = __DIR__.'/../src/';
    public string $baseNamespace = 'Webparking\Logic4Client';

    /** @var array<string, Schema> */
    private array $components = [];
    private ComponentClassGenerator $componentClassGenerator;
    private bool $setupHasRun = false;
    private bool $refresh = false;

    public function __construct(private readonly ApiDocumentationSource $documentationSource)
    {
    }

    public function setup(): void
    {
        if (!$this->setupHasRun) {
            Helpers::emptyDirectory($this->baseDirectory.'/Responses');
            Helpers::emptyDirectory($this->baseDirectory.'/Data');

            $this->setupHasRun = true;
        }
    }

    /** @return array<string, string> version => url */
    public function resolveVersions(): array
    {
        $contents = $this->download($this->documentationSource->scalarUrl());

        return $this->resolveVersionsFromScalar($contents);
    }

    /** @return array<string, string> version => url */
    public function resolveVersionsFromScalar(string $contents): array
    {
        preg_match('/initialize\([^,]+,\s*\w+,\s*(\{.+\})\s*,\s*\'/s', $contents, $matches);

        Assert::keyExists($matches, 1, 'Could not find Scalar configuration');

        $config = json_decode($matches[1], true, 512, \JSON_THROW_ON_ERROR);

        Assert::isArray($config, 'Invalid Scalar configuration');
        Assert::keyExists($config, 'sources', 'Could not find API sources');
        Assert::isArray($config['sources'], 'Invalid Scalar API sources');

        $versions = [];
        foreach ($config['sources'] as $source) {
            Assert::isArray($source, 'Invalid Scalar API source');
            Assert::keyExists($source, 'title', 'Scalar API source has no title');
            Assert::keyExists($source, 'url', 'Scalar API source has no URL');
            Assert::string($source['title'], 'Invalid Scalar API source title');
            Assert::string($source['url'], 'Invalid Scalar API source URL');

            if (preg_match('/Version v(\d+\.\d+)/', $source['title'], $versionMatch)) {
                $versions[$versionMatch[1]] = $this->documentationSource->openApiUrl($source['url']);
            }
        }

        return $versions;
    }

    public function generate(string $version, string $remoteUrl): void
    {
        $localFile = $this->downloadApiDocumentation($version, $remoteUrl);

        $openapi = Reader::readFromJsonFile($localFile, resolveReferences: false);

        Helpers::emptyDirectory(\sprintf('%s/Requests/%s', $this->baseDirectory, $this->getVersion($version)));
        Helpers::emptyDirectory(\sprintf('%s/Data/%s', $this->baseDirectory, $this->getVersion($version)));
        Helpers::emptyDirectory(\sprintf('%s/Responses/%s', $this->baseDirectory, $this->getVersion($version)));

        $this->components = $openapi->components->schemas;

        $this->componentClassGenerator = new ComponentClassGenerator(
            $this->baseNamespace,
            $this->baseDirectory,
            $this->components
        );

        $groupedPaths = [];
        foreach ($openapi->paths->getPaths() as $uri => $pathItem) {
            $methods = [
                'get' => $pathItem->get,
                'post' => $pathItem->post,
                'patch' => $pathItem->patch,
                'put' => $pathItem->put,
                'delete' => $pathItem->delete,
            ];

            foreach ($methods as $method => $operation) {
                if ($operation) {
                    $namespace = $operation->tags[0] ?? 'default';
                    $groupedPaths[$namespace][$uri][$method] = $operation;
                }
            }
        }

        foreach ($groupedPaths as $namespace => $uriList) {
            $this->processNamespace($namespace, $uriList, $version);
        }
    }

    public function downloadApiDocumentation(string $version, string $remoteUrl): string
    {
        $localFile = \sprintf(
            $this->localApi,
            $this->documentationSource->value,
            $this->getVersion($version),
        );

        if ($this->refresh && is_file($localFile)) {
            unlink($localFile);
        }

        if (!is_file($localFile)) {
            file_put_contents($localFile, $this->download($remoteUrl));
        }

        return $localFile;
    }

    /** @param array<string, array<string, Operation>> $operations */
    private function processNamespace(string $namespace, array $operations, string $version): void
    {
        $requestGenerator = new RequestClassGenerator(
            namespace: $this->baseNamespace,
            version: $this->getVersion($version),
            className: $namespace.'Request',
            componentClassGenerator: $this->componentClassGenerator,
        );

        foreach ($operations as $uri => $operationList) {
            foreach ($operationList as $method => $operation) {
                $requestProperties = $operation->requestBody?->content['application/json']?->schema;
                $responseReference = $operation->responses['200']->content['application/json']->schema ?? null;

                if ($responseReference instanceof Schema) {
                    $returnType = Helpers::primaryType($responseReference->type);

                    $arrayType = null;
                    if ('array' === $returnType && $responseReference->items instanceof Reference) {
                        $arrayType = $this->componentClassGenerator->resolve(
                            $responseReference->items->getReference(),
                            'Responses',
                            $this->getVersion($version)
                        );
                    } elseif ('array' === $returnType && $responseReference->items instanceof Schema) {
                        $itemType = Helpers::primaryType($responseReference->items->type);
                        $arrayType = Helpers::phpType($itemType, $itemType ?? 'mixed');
                    }

                    $classMethod = $requestGenerator->addMethod($method, $uri, $operation, $returnType, arrayType: $arrayType);
                } elseif ($responseReference instanceof Reference) {
                    $requestSchema = $requestProperties instanceof Reference
                        ? $this->resolveReference($requestProperties->getReference())->properties
                        : [];

                    $responseSchema = $this->resolveReference($responseReference->getReference())->properties;

                    $takeRecords = \array_key_exists('TakeRecords', $requestSchema) && \array_key_exists('SkipRecords', $requestSchema);
                    $take = \array_key_exists('Take', $requestSchema) && \array_key_exists('Skip', $requestSchema);

                    $paginatedResponse = ($takeRecords || $take)
                        && \array_key_exists('Records', $responseSchema)
                        && \array_key_exists('RecordsCounter', $responseSchema)
                        && $responseSchema['Records'] instanceof Schema
                        && $responseSchema['Records']->items instanceof Reference;

                    if ($paginatedResponse) {
                        $returnType = $this->componentClassGenerator
                            ->resolve($responseSchema['Records']->items->getReference(), 'Data', $this->getVersion($version));

                        $paginatedResponse = $take ? PaginateType::Take : PaginateType::TakeRecords;
                    } else {
                        $returnType = $this->componentClassGenerator->resolve(
                            $responseReference->getReference(),
                            'Responses',
                            $this->getVersion($version)
                        );
                    }

                    $classMethod = $requestGenerator->addMethod($method, $uri, $operation, returnType: $returnType, paginated: $paginatedResponse ?: null);
                } else {
                    $classMethod = $requestGenerator->addMethod($method, $uri, $operation, void: true);
                }

                if ($operation->description) {
                    $classMethod->setComment($operation->description."\n\n".$classMethod->getComment());
                }

                if ($operation->deprecated) {
                    $classMethod->addComment('@deprecated '.$operation->summary);
                }
            }
        }

        $requestGenerator->write($this->baseDirectory);
    }

    private function resolveReference(string $reference): Schema
    {
        $reference = $this->normalizeRef($reference);

        return $this->components[$reference];
    }

    public function normalizeRef(string $reference): string
    {
        return str_replace('#/components/schemas/', '', $reference);
    }

    public function getVersion(string $version): string
    {
        return \sprintf('V%s', str_replace('.', '', $version));
    }

    public function setRefresh(bool $refresh): void
    {
        $this->refresh = $refresh;
    }

    private function download(string $url): string
    {
        $context = stream_context_create([
            'http' => [
                'follow_location' => 0,
                'timeout' => 30,
                'user_agent' => 'webparking/logic4-client-generator',
            ],
        ]);

        $contents = file_get_contents($url, false, $context);

        Assert::string($contents, \sprintf('Could not fetch API documentation from %s', $url));

        return $contents;
    }
}
