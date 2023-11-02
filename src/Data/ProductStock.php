<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductStock
{
    public function __construct(
        public ?string $productCode,
        public int $warehouseId,
        public float $qtyReserved,
        public float $freeStock,
        public int $productId,
        public float $qty,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productCode: $data['ProductCode'] ?? null,
            warehouseId: $data['WarehouseId'] ?? 0,
            qtyReserved: $data['QtyReserved'] ?? 0.0,
            freeStock: $data['FreeStock'] ?? 0.0,
            productId: $data['ProductId'] ?? 0,
            qty: $data['Qty'] ?? 0.0,
        );
    }
}
