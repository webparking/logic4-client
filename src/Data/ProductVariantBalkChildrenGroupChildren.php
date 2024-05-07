<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductVariantBalkChildrenGroupChildren
{
    /** @param array<ProductVariantBalkChildrenGroupChildVariantOptions> $variantOptions */
    public function __construct(
        public int $productId,
        public ?array $variantOptions,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            variantOptions: array_map(static fn (array $item) => ProductVariantBalkChildrenGroupChildVariantOptions::make($item), $data['VariantOptions'] ?? []),
        );
    }
}
