<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductAssemblyRecipeItem
{
    public function __construct(
        public int $productId,
        public ?string $productCode,
        public float $qty,
        public ?int $sorting,
        public bool $isStockBasedProduct,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            productCode: $data['ProductCode'] ?? null,
            qty: $data['Qty'] ?? 0.0,
            sorting: $data['Sorting'] ?? null,
            isStockBasedProduct: $data['IsStockBasedProduct'] ?? false,
        );
    }
}
