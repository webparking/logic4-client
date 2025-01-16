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
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }
    }

    public static function resolveParameterType(Schema|Reference $property): string
    {
        if ($property instanceof Reference) {
            $property = $property->resolve();
        }

        if ('array' === $property->type) {
            if ($property->items instanceof Reference) {
                $property = clone $property;

                $property->resolveReferences();
            }

            if ($property->items instanceof Schema) {
                $type = sprintf('array<%s>', self::resolveParameterType($property->items));
            } else {
                $type = 'array<mixed>';
            }
        } elseif ('object' === $property->type) {
            $properties = [];
            foreach ($property->properties as $parameterName => $propertyValue) {
                $properties[] = sprintf('%s?: %s%s', $parameterName, self::resolveParameterType($propertyValue), $propertyValue->nullable ?? false ? '|null' : '');
            }

            $type = sprintf('array{%s}', implode(', ', $properties));
        } else {
            $type = $property->type;
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
                $parameters[] = sprintf($format, sprintf('%s?: %s|null', $name, self::resolveParameterType($property)));
            }
        }

        return $parameters;
    }

    public static function phpType(mixed $type, string $default = 'mixed'): string
    {
        return match ($type) {
            'integer' => 'int',
            'number' => 'float',
            'boolean' => 'bool',
            default => $default,
        };
    }
}
