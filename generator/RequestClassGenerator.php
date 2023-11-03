<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

use cebe\openapi\spec\Operation;
use cebe\openapi\spec\Reference;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Nette\PhpGenerator\PhpNamespace;
use Symfony\Component\Filesystem\Path;
use Webparking\Logic4Client\Request;

class RequestClassGenerator
{
    private ClassType $class;

    public function __construct(
        public string $namespace,
        public string $className,
        public ComponentClassGenerator $componentClassGenerator,
    ) {
        $this->class = new ClassType($this->className, new PhpNamespace($this->namespace.'\Requests'));

        $this->class->setExtends(Request::class);
    }

    public function addMethod(string $httpMethod, string $uri, Operation $operation, string $returnType = null, bool $paginated = false): Method
    {
        $action = last(explode('/', ltrim($uri, '/')));
        $requestProperties = $operation->requestBody?->content['application/json']?->schema;
        $requestProperties = $requestProperties instanceof Reference
            ? $requestProperties->resolve()?->properties ?? []
            : $requestProperties?->properties ?? [];

        $method = $this
            ->class
            ->addMethod(lcfirst($action))
            ->setReturnType($returnType);

        $requestParameters = [];
        foreach ($operation->parameters as $parameter) {
            if ('query' !== $parameter->in) {
                continue;
            }

            $parameterType = match ($parameter->schema->type) {
                'integer' => 'int',
                'number' => 'float',
                'boolean' => 'bool',
                default => $parameter->schema->type,
            };

            $method
                ->addParameter($parameter->name)
                ->setType($parameterType);

            $requestParameters['query'][$parameter->name] = sprintf('{$%s}', $parameter->name);
        }

        if ($requestProperties) {
            $method->addParameter('parameters')
                ->setType('array')
                ->setDefaultValue([]);

            $method
                ->addComment("@param array{\n".implode("\n", Helpers::makePhpDoc($requestProperties, '    %s,'))."\n} \$parameters");

            $parameterType = 'get' === $httpMethod ? 'query' : 'json';
            $requestParameters[$parameterType] = '{$parameters}';
        }

        $method->addComment("\n@throws Logic4ApiException");

        $parametersPhp = $requestParameters
            ? ', '.preg_replace('/\'\{\$(.*)\}\'/', '\$$1', var_export($requestParameters, true))
            : '';

        $returnType = match ($returnType) {
            'integer' => 'int',
            'number' => 'float',
            'boolean' => 'bool',
            default => $returnType ?? 'mixed',
        };

        if ($paginated && class_exists($returnType)) {
            $method->setReturnType(\Generator::class);
            $method->addComment("\n@return \Generator<array-key, ".(class_exists($returnType) ? '\\'.$returnType : $returnType).'>');
        } else {
            $method->setReturnType($returnType);
            $method->addComment("\n@return ".(class_exists($returnType) ? '\\'.$returnType : $returnType));
        }

        if (class_exists($returnType)) {
            if ($paginated) {
                $method->setBody(
                    <<<PHP
                        \$iterator = \$this->paginateRecords('{$uri}', \$parameters);

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
        $outputFile = $baseDirectory.'Requests/'.$this->className.'.php';

        Helpers::createDirectory(Path::getDirectory($outputFile));

        file_put_contents(
            $outputFile,
            <<<FILE
                <?php

                declare(strict_types=1);

                namespace {$this->namespace}\Requests;

                use Webparking\Logic4Client\Exceptions\Logic4ApiException;

                {$this->class}

                FILE
        );
    }
}
