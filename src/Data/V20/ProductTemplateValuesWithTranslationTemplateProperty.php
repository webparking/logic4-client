<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductTemplateValuesWithTranslationTemplateProperty
{
    /** @param array<ProductTemplateValuesWithTranslationTemplatePropertyValue> $values */
    public function __construct(
        public int $templatePropertyId,
        public ?array $values,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            templatePropertyId: $data['TemplatePropertyId'] ?? 0,
            values: array_map(static fn (array $item) => ProductTemplateValuesWithTranslationTemplatePropertyValue::make($item), $data['Values'] ?? []),
        );
    }
}
