<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class ProductVariantBalkChildrenGroup
{
    /** @param array<\Webparking\Logic4Client\Data\V30\ProductVariantBalkChildrenGroupChildren> $children */
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
            children: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\ProductVariantBalkChildrenGroupChildren::make($item), $data['Children'] ?? []),
        );
    }
}
