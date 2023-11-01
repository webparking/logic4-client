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
            templatePropertyId: $data['TemplatePropertyId'],
            name: $data['Name'],
            unit: $data['Unit'],
            remark: $data['Remark'],
            values: $data['Values'],
        );
    }
}
