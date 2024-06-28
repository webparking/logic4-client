<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

use cebe\openapi\spec\Operation;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpNamespace;
use Symfony\Component\Filesystem\Path;
use Webparking\Logic4Client\Enums\PaginateType;
use Webparking\Logic4Client\Request;

class RequestClassGenerator
{
    private ClassType $class;

    public function __construct(
        public string $namespace,
        public string $version,
        public string $className,
        public ComponentClassGenerator $componentClassGenerator,
    ) {
        $this->class = new ClassType($this->className, new PhpNamespace(sprintf('%s\Requests\%s', $this->namespace, $this->version)));
        $this->class->setExtends(Request::class);
    }

    public function addMethod(string $httpMethod, string $uri, Operation $operation, ?string $returnType = null, ?PaginateType $paginated = null): Method
    {
        $action = last(explode('/', ltrim($uri, '/')));
        $requestSchema = $operation->requestBody?->content['application/json']?->schema;

        $method = $this
            ->class
            ->addMethod(lcfirst($action))
            ->setReturnType($returnType);

        $requestParameters = [];
        foreach ($operation->parameters as $parameter) {
            if ('query' !== $parameter->in) {
                continue;
            }

            $parameterType = Helpers::phpType($parameter->schema->type, $parameter->schema->type);

            $method
                ->addParameter($parameter->name)
                ->setType($parameterType);

            $requestParameters['query'][$parameter->name] = sprintf('{$%s}', $parameter->name);
        }

        if ($requestSchema instanceof Reference
            || 'array' === $requestSchema?->type
        ) {
            if ($requestSchema instanceof Reference) {
                $requestProperties = $requestSchema->resolve()?->properties ?? [];
                $parameterDoc = "array{\n".implode("\n", Helpers::makePhpDoc($requestProperties, '    %s,'))."\n}";
            } else {
                if ($requestSchema->items instanceof Schema) {
                    $parameterDoc = "array<{$requestSchema->items->type}>";
                } else {
                    $requestProperties = $requestSchema->items->resolve()->properties;

                    $parameterDoc = "array<array{\n".implode("\n", Helpers::makePhpDoc($requestProperties, '    %s,'))."\n}>";
                }
            }

            $method->addParameter('parameters')
                ->setType('array')
                ->setDefaultValue([]);

            $method
                ->addComment("@param $parameterDoc \$parameters");

            $parameterType = 'get' === $httpMethod ? 'query' : 'json';
            $requestParameters[$parameterType] = '{$parameters}';
        } elseif (null !== $requestSchema?->type) {
            $method->addParameter('value')
                ->setType(Helpers::phpType($requestSchema?->type));

            $parameterType = 'get' === $httpMethod ? 'query' : 'json';
            $requestParameters[$parameterType] = '{$value}';
        }

        $method->addComment("\n@throws Logic4ApiException");

        $parametersPhp = $requestParameters
            ? ', '.preg_replace('/\'\{\$(.*)\}\'/', '\$$1', var_export($requestParameters, true))
            : '';

        $returnType = Helpers::phpType($returnType, $returnType ?? 'mixed');

        if ($paginated && class_exists($returnType)) {
            $method->setReturnType(\Generator::class);
            $method->addComment("\n@return \Generator<array-key, ".(class_exists($returnType) ? '\\'.$returnType : $returnType).'>');
        } else {
            $method->setReturnType($returnType);
            $method->addComment("\n@return ".(class_exists($returnType) ? '\\'.$returnType : $returnType));
        }

        if (class_exists($returnType)) {
            if ($paginated) {
                $paginateMethod = match ($paginated) {
                    PaginateType::TakeRecords => "\$this->paginateRecords('{$uri}', \$parameters);",
                    PaginateType::Take => "\$this->paginateRecords('{$uri}', \$parameters, 'Take', 'Skip');",
                };

                $method->setBody(
                    <<<PHP
                        \$iterator = $paginateMethod

                        foreach (\$iterator as \$record) {
                            yield \\$returnType::make(\$record);
                        }
                        PHP
                );
            } else {
                $method->setBody(
                    <<<PHP
                        return \\$returnType::make(
                            \$this->buildResponse(
                                \$this->getClient()->{$httpMethod}('{$uri}'{$parametersPhp}),
                            )
                        );
                        PHP
                );
            }
        } else {
            $method->setBody(
                <<<PHP
                    return \$this->buildResponse(
                        \$this->getClient()->{$httpMethod}('{$uri}'{$parametersPhp}),
                    );
                    PHP
            );
        }

        return $method;
    }

    public function write(string $baseDirectory): void
    {
        $outputFile = $baseDirectory.'Requests/'.$this->version.'/'.$this->className.'.php';

        Helpers::createDirectory(Path::getDirectory($outputFile));

        file_put_contents(
            $outputFile,
            <<<FILE
                <?php

                declare(strict_types=1);

                namespace {$this->namespace}\\Requests\\{$this->version};

                use Webparking\Logic4Client\Exceptions\Logic4ApiException;

                {$this->class}

                FILE
        );
    }
}
