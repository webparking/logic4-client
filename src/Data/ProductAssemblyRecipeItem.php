<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            productId: $data['ProductId'],
            productCode: $data['ProductCode'],
            qty: $data['Qty'],
            sorting: $data['Sorting'],
            isStockBasedProduct: $data['IsStockBasedProduct'],
        );
    }
}
