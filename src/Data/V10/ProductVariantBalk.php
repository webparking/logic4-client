<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductVariantBalk
{
    /**
     * @param array<ProductVariant>                $productVariants
     * @param array<ProductVariantBalkTranslation> $productVariantBalkTranslations
     */
    public function __construct(
        public ?string $name,
        public int $id,
        public ?array $productVariants,
        public ?array $productVariantBalkTranslations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            name: $data['Name'] ?? null,
            id: $data['Id'] ?? 0,
            productVariants: array_map(static fn (array $item) => ProductVariant::make($item), $data['ProductVariants'] ?? []),
            productVariantBalkTranslations: array_map(static fn (array $item) => ProductVariantBalkTranslation::make($item), $data['ProductVariantBalkTranslations'] ?? []),
        );
    }
}
