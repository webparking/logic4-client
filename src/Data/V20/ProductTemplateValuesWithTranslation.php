<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductTemplateValuesWithTranslation
{
    /** @param array<ProductTemplateValuesWithTranslationTemplateProperty> $templates */
    public function __construct(
        public int $productId,
        public ?array $templates,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            templates: array_map(static fn (array $item) => ProductTemplateValuesWithTranslationTemplateProperty::make($item), $data['Templates'] ?? []),
        );
    }
}
