<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductTemplateProperty
{
    /**
     * @param array<Translation> $nameTranslations
     * @param array<Translation> $filterInfomations
     * @param array<Translation> $unitTranslations
     * @param array<string>      $values
     */
    public function __construct(
        public int $templatePropertyId,
        public ?string $name,
        public ?array $nameTranslations,
        public ?array $filterInfomations,
        public ?string $unit,
        public ?array $unitTranslations,
        public ?string $remark,
        public ?array $values,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            templatePropertyId: $data['TemplatePropertyId'] ?? 0,
            name: $data['Name'] ?? null,
            nameTranslations: array_map(static fn (array $item) => Translation::make($item), $data['NameTranslations'] ?? []),
            filterInfomations: array_map(static fn (array $item) => Translation::make($item), $data['FilterInfomations'] ?? []),
            unit: $data['Unit'] ?? null,
            unitTranslations: array_map(static fn (array $item) => Translation::make($item), $data['UnitTranslations'] ?? []),
            remark: $data['Remark'] ?? null,
            values: $data['Values'] ?? null,
        );
    }
}
