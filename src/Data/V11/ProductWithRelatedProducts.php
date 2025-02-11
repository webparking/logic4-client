<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductWithRelatedProducts
{
    /** @param array<RelatedProduct> $relatedProducts */
    public function __construct(
        public int $productId,
        public ?array $relatedProducts,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            relatedProducts: array_map(static fn (array $item) => RelatedProduct::make($item), $data['RelatedProducts'] ?? []),
        );
    }
}
