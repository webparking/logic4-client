<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductTemplatesWithTranslation
{
    /**
     * @param array<ProductTemplateValuesWithTranslation>   $productTemplates
     * @param array<ProductTemplatePropertyWithTranslation> $productTemplateTranslations
     */
    public function __construct(
        public ?array $productTemplates,
        public ?array $productTemplateTranslations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productTemplates: array_map(static fn (array $item) => ProductTemplateValuesWithTranslation::make($item), $data['ProductTemplates'] ?? []),
            productTemplateTranslations: array_map(static fn (array $item) => ProductTemplatePropertyWithTranslation::make($item), $data['ProductTemplateTranslations'] ?? []),
        );
    }
}
