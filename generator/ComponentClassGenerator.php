<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

use Carbon\Carbon;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use Symfony\Component\Filesystem\Path;
use Webmozart\Assert\Assert;

class ComponentClassGenerator
{
    /** @param array<string, Schema> $components */
    public function __construct(
        public string $namespace,
        public string $directory,
        public array $components,
    ) {
    }

    public function resolve(string $name, string $namespace, string $version): string
    {
        if ($version) {
            $namespace .= '\\'.$version;
        }

        if ('Data' === $namespace) {
            Assert::notNull($version, 'Version must be set when resolving Data namespace');
        }

        $componentName = str_replace('#/components/schemas/', '', $name);
        $name = (string) str_replace('_', '', $componentName);
        $directory = $this->directory.str_replace('\\', '/', $namespace);
        $targetFile = $directory.'/'.$name.'.php';
        $className = $this->namespace.'\\'.$namespace.'\\'.$name;

        if (is_file($targetFile)) {
            unlink($targetFile);
        }

        $component = $this->components[$componentName];
        $class = new ClassType($name, new PhpNamespace($this->namespace.'\\'.$namespace));

        $constructor = $class
            ->addMethod('__construct');

        $typedParameters = [];
        $arrayParameters = [];
        $dateParameters = [];

        foreach ($component->properties as $parameterName => $parameter) {
            if ($parameter instanceof Reference) {
                $type = $this->resolve($parameter->getReference(), 'Data', $version);
                $typedParameters[$parameterName] = $type;
            } else {
                $type = Helpers::phpType($parameter->type, $parameter->type);

                if ('string' === $parameter->type && 'date-time' === $parameter->format) {
                    $type = Carbon::class;

                    $dateParameters[] = $parameterName;
                }

                if ('array' === $type) {
                    if ($parameter->items instanceof Reference) {
                        $commentType = $this->resolve($parameter->items->getReference(), 'Data', $version);
                        $arrayParameters[$parameterName] = $commentType;
                        $commentType = '\\'.$commentType;
                    } else {
                        $commentType = $parameter->items?->type ?? 'mixed';
                    }

                    $constructor->addComment('@param array<'.$commentType.'> $'.$this->propertyName($parameterName));
                }
            }

            $nullable = !\in_array($parameterName, ['Records', 'ValidationMessages'], true) && (($parameter->nullable ?? false) || class_exists($type));

            $constructor
                ->addPromotedParameter($this->propertyName($parameterName))
                ->setNullable($nullable)
                ->setType($type);
        }

        $makeMethod = "return new self(\n";
        foreach ($component->properties as $property => $propertyObject) {
            $constructorProperty = $constructor->getParameter($this->propertyName($property));

            $default = $constructorProperty->isNullable()
                ? ' ?? null'
                : match ($constructorProperty->getType()) {
                    'int' => ' ?? 0',
                    'float' => ' ?? 0.0',
                    'bool' => ' ?? false',
                    'string' => ' ?? \'\'',
                    'array' => ' ?? []',
                    default => ' ?? null',
                };

            $assignment = null;
            $assignmentValue = "\$data['$property']$default";
            if ($typedParameter = $typedParameters[$property] ?? null) {
                $assignment = "\\$typedParameter::make(\$data['$property'])";
            } elseif ($arrayParameter = $arrayParameters[$property] ?? null) {
                $assignmentValue = "array_map(static fn (array \$item) => \\$arrayParameter::make(\$item), \$data['$property'] ?? [])";
            } elseif (\in_array($property, $dateParameters, true)) {
                $assignment = sprintf("\\%s::parse(\$data['%s'])", Carbon::class, $property);
            }

            if (null === $assignment) {
                $assignment = $assignmentValue;
            } else {
                $assignment = "isset(\$data['$property']) ? $assignment : null";
            }

            $makeMethod .= "\t{$this->propertyName($property)}: $assignment,\n";
        }

        $class
            ->addMethod('make')
            ->setStatic()
            ->setReturnType('self')
            ->setComment('@param array<mixed> $data')
            ->setBody("$makeMethod);")
            ->addParameter('data')
            ->setType('array');

        Helpers::createDirectory(Path::getDirectory($targetFile));

        file_put_contents(
            $targetFile,
            <<<FILE
                <?php

                declare(strict_types=1);

                namespace {$this->namespace}\\$namespace;

                {$class}

                FILE
        );

        return $className;
    }

    private function propertyName(string $name): string
    {
        $name = str_replace('_', '', $name);

        return preg_match('/^[A-Z]{2}/', $name)
            ? $name
            : lcfirst($name);
    }
}
