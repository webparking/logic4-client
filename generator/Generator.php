<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

use cebe\openapi\Reader;
use cebe\openapi\spec\Operation;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use Webmozart\Assert\Assert;

class Generator
{
    public bool $refresh = false;

    public string $remoteApi = 'https://api.logic4server.nl/swagger/latest/swagger.json';
    public string $localApi = __DIR__.'/../logic4-api.json';

    public string $baseDirectory = __DIR__.'/../src/';
    public string $namespace = 'Webparking\Logic4Client';

    /** @var array<string, Schema> */
    private array $components = [];
    private ComponentClassGenerator $componentClassGenerator;

    public function generate(): string
    {
        $this->downloadApiDocumentation();

        $openapi = Reader::readFromJsonFile($this->localApi, resolveReferences: false);

        Helpers::emptyDirectory($this->baseDirectory.'/Requests');
        Helpers::emptyDirectory($this->baseDirectory.'/Responses');
        Helpers::emptyDirectory($this->baseDirectory.'/Data');
        Helpers::emptyDirectory($this->baseDirectory.'/Components');

        $this->components = $openapi->components->schemas;

        $this->componentClassGenerator = new ComponentClassGenerator(
            $this->namespace,
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
            ];

            foreach ($methods as $method => $operation) {
                if ($operation) {
                    $namespace = $operation->tags[0] ?? 'default';
                    $groupedPaths[$namespace][$uri][$method] = $operation;
                }
            }
        }

        foreach ($groupedPaths as $namespace => $uriList) {
            $this->processNamespace($namespace, $uriList);
        }

        return 'Generated API classes at '.now()->toDateTimeString();
    }

    public function downloadApiDocumentation(): void
    {
        if ($this->refresh && is_file($this->localApi)) {
            unlink($this->localApi);
        }

        if (!is_file($this->localApi)) {
            file_put_contents($this->localApi, file_get_contents($this->remoteApi));
        }
    }

    public function setRefresh(bool $refresh): self
    {
        $this->refresh = $refresh;

        return $this;
    }

    /** @param array<string, array<string, Operation>> $operations */
    private function processNamespace(string $namespace, array $operations): void
    {
        $requestGenerator = new RequestClassGenerator(
            namespace: $this->namespace,
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
                    $paginatedResponse = \array_key_exists('Records', $responseSchema)
                        && \array_key_exists('RecordsCounter', $responseSchema)
                        && \array_key_exists('TakeRecords', $requestSchema)
                        && \array_key_exists('SkipRecords', $requestSchema)
                        && $responseSchema['Records'] instanceof Schema
                        && $responseSchema['Records']->items instanceof Reference;

                    if ($paginatedResponse) {
                        $returnType = $this->componentClassGenerator
                            ->resolve($responseSchema['Records']->items->getReference(), 'Data');
                    } else {
                        $paginatedResponse = false;
                        $returnType = $this->componentClassGenerator->resolve(
                            $responseReference->getReference(),
                            'Responses',
                        );
                    }

                    $classMethod = $requestGenerator->addMethod($method, $uri, $operation, returnType: $returnType, paginated: $paginatedResponse);
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
}
