<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;

class Helpers
{
    /** @param string|string[] $keepFiles */
    public static function emptyDirectory(string $path, string|array|null $keepFiles = null): void
    {
        if (!is_dir($path)) {
            return;
        }

        foreach (scandir($path) ?: [] as $file) {
            if ('.' === $file || '..' === $file || \in_array($file, (array) $keepFiles, true)) {
                continue;
            }

            if (is_dir($path.'/'.$file)) {
                self::emptyDirectory($path.'/'.$file);
            } else {
                unlink($path.'/'.$file);
            }
        }

        if (null === $keepFiles) {
            rmdir($path);
        }
    }

    public static function createDirectory(string $path): void
    {
        if (!is_dir($path)) {
            if (!mkdir($path, 0o755, true) && !is_dir($path)) {
                throw new \RuntimeException(\sprintf('Directory "%s" was not created', $path));
            }
        }
    }

    public static function resolveParameterType(Schema|Reference $property): string
    {
        if ($property instanceof Reference) {
            $property = $property->resolve();
        }

        $primary = self::primaryType($property->type);

        if ('array' === $primary) {
            if ($property->items instanceof Reference) {
                $property = clone $property;

                $property->resolveReferences();
            }

            if ($property->items instanceof Schema) {
                $type = \sprintf('array<%s>', self::resolveParameterType($property->items));
            } else {
                $type = 'array<mixed>';
            }
        } elseif ('object' === $primary) {
            $properties = [];
            foreach ($property->properties as $parameterName => $propertyValue) {
                $properties[] = \sprintf('%s?: %s', $parameterName, self::resolveParameterType($propertyValue));
            }

            $type = \sprintf('array{%s}', implode(', ', $properties));
        } else {
            $type = ($primary ?? 'mixed').(self::isNullable($property) ? '|null' : '');
        }

        return $type;
    }

    /**
     * @param Reference[]|Schema[] $properties
     *
     * @return array<mixed>
     */
    public static function makePhpDoc(array $properties, string $format): array
    {
        $parameters = [];
        foreach ($properties as $name => $property) {
            if ($property instanceof Reference) {
                $property = $property->resolve();
            }

            if ($property instanceof Schema) {
                $parameters[] = \sprintf($format, \sprintf('%s?: %s', $name, self::resolveParameterType($property)));
            }
        }

        return $parameters;
    }

    public static function isEnum(Schema $schema): bool
    {
        return [] !== ($schema->enum ?? []);
    }

    public static function enumPhpType(Schema $schema): string
    {
        $primary = self::primaryType($schema->type);

        if (null !== $primary) {
            return self::phpType($primary, $primary);
        }

        foreach ($schema->enum ?? [] as $value) {
            if (\is_int($value)) {
                return 'int';
            }

            if (\is_float($value)) {
                return 'float';
            }

            if (\is_bool($value)) {
                return 'bool';
            }

            if (\is_string($value)) {
                return 'string';
            }
        }

        return 'string';
    }

    public static function phpType(mixed $type, string $default = 'mixed'): string
    {
        if (\is_array($type)) {
            $type = self::primaryType($type);
        }

        return match ($type) {
            'integer' => 'int',
            'number' => 'float',
            'boolean' => 'bool',
            default => $default,
        };
    }

    public static function primaryType(mixed $type): ?string
    {
        if (\is_array($type)) {
            foreach ($type as $candidate) {
                if (\is_string($candidate) && 'null' !== $candidate) {
                    return $candidate;
                }
            }

            return null;
        }

        return \is_string($type) ? $type : null;
    }

    public static function isNullable(Schema|Reference $property): bool
    {
        if ($property instanceof Reference) {
            return false;
        }

        if (\is_array($property->type) && \in_array('null', $property->type, true)) {
            return true;
        }

        return (bool) ($property->nullable ?? false);
    }
}
