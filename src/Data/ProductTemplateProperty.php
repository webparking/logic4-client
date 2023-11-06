<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductTemplateProperty
{
    /** @param array<string> $values */
    public function __construct(
        public int $templatePropertyId,
        public ?string $name,
        public ?string $unit,
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
            unit: $data['Unit'] ?? null,
            remark: $data['Remark'] ?? null,
            values: $data['Values'] ?? null,
        );
    }
}
