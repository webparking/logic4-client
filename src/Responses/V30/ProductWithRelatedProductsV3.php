<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class ProductWithRelatedProductsV3
{
    /** @param array<\Webparking\Logic4Client\Data\V30\RelatedProductV3> $relatedProducts */
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
            relatedProducts: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\RelatedProductV3::make($item), $data['RelatedProducts'] ?? []),
        );
    }
}
