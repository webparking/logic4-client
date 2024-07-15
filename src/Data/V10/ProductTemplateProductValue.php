<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductTemplateProductValue
{
    /** @param array<string> $values */
    public function __construct(
        public int $productId,
        public int $templatePropertyId,
        public ?array $values,
        public ?string $templatePropertyName,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            templatePropertyId: $data['TemplatePropertyId'] ?? 0,
            values: $data['Values'] ?? null,
            templatePropertyName: $data['TemplatePropertyName'] ?? null,
        );
    }
}
