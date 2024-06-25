<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

use cebe\openapi\Reader;
use cebe\openapi\spec\Operation;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use Webmozart\Assert\Assert;
use Webparking\Logic4Client\Enums\PaginateType;

class Generator
{
    public static string $swaggerUrl = 'https://api.logic4server.nl/swagger/index.html';
    public string $remoteApi = 'https://api.logic4server.nl/swagger/%s/swagger.json';
    public string $localApi = __DIR__.'/../logic4-api-%s.json';

    public string $baseDirectory = __DIR__.'/../src/';
    public string $baseNamespace = 'Webparking\Logic4Client';

    /** @var array<string, Schema> */
    private array $components = [];
    private ComponentClassGenerator $componentClassGenerator;
    private bool $setupHasRun = false;
    private bool $refresh = false;

    public function setup(): void
    {
        if (!$this->setupHasRun) {
            Helpers::emptyDirectory($this->baseDirectory.'/Responses');
            Helpers::emptyDirectory($this->baseDirectory.'/Data');

            $this->setupHasRun = true;
        }
    }

    /** @return array<string> */
    public static function resolveVersions(): array
    {
        $contents = file_get_contents(self::$swaggerUrl);

        Assert::string($contents, 'Could not fetch API documentation');

        preg_match('/configObject = JSON.parse\(\'(.*)\'\);/', $contents, $matches);

        $versions = json_decode($matches[1], true, 512, \JSON_THROW_ON_ERROR);

        Assert::keyExists($versions, 'urls', 'Could not find API versions');

        return array_diff(
            array_map(static fn ($version) => explode('/', $version['url'], 2)[0], $versions['urls']),
            ['latest'],
        );
    }

    public function generate(string $version): void
    {
        $localFile = $this->downloadApiDocumentation($version);

        $openapi = Reader::readFromJsonFile($localFile, resolveReferences: false);

        Helpers::emptyDirectory(sprintf('%s/Requests/%s', $this->baseDirectory, $this->getVersion($version)));

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

    public function downloadApiDocumentation(string $version): string
    {
        $localFile = sprintf($this->localApi, $this->getVersion($version));
        $remoteFile = sprintf($this->remoteApi, $version);

        if ($this->refresh && is_file($localFile)) {
            unlink($localFile);
        }

        if (!is_file($localFile)) {
            file_put_contents($localFile, file_get_contents($remoteFile));
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
                    $classMethod = $requestGenerator->addMethod($method, $uri, $operation, returnType: $responseReference->type);
                } else {
                    Assert::isInstanceOf($responseReference, Reference::class);

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
                            ->resolve($responseSchema['Records']->items->getReference(), 'Data');

                        $paginatedResponse = $take ? PaginateType::Take : PaginateType::TakeRecords;
                    } else {
                        $returnType = $this->componentClassGenerator->resolve(
                            $responseReference->getReference(),
                            'Responses',
                        );
                    }

                    $classMethod = $requestGenerator->addMethod($method, $uri, $operation, returnType: $returnType, paginated: $paginatedResponse ?: null);
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
        return sprintf('V%s', str_replace('.', '', $version));
    }

    public function setRefresh(bool $refresh): void
    {
        $this->refresh = $refresh;
    }
}
