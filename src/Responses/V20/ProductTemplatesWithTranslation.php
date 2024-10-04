<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V20;

class ProductTemplatesWithTranslation
{
    /**
     * @param array<\Webparking\Logic4Client\Data\V20\ProductTemplateValuesWithTranslation>   $productTemplates
     * @param array<\Webparking\Logic4Client\Data\V20\ProductTemplatePropertyWithTranslation> $productTemplateTranslations
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
            productTemplates: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V20\ProductTemplateValuesWithTranslation::make($item), $data['ProductTemplates'] ?? []),
            productTemplateTranslations: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V20\ProductTemplatePropertyWithTranslation::make($item), $data['ProductTemplateTranslations'] ?? []),
        );
    }
}
