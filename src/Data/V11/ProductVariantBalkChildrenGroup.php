<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductVariantBalkChildrenGroup
{
    /** @param array<ProductVariantBalkChildrenGroupChildren> $children */
    public function __construct(
        public int $productId,
        public ?array $children,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            children: array_map(static fn (array $item) => ProductVariantBalkChildrenGroupChildren::make($item), $data['Children'] ?? []),
        );
    }
}
