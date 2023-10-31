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
            productCode: $data['ProductCode'],
            warehouseId: $data['WarehouseId'],
            qtyReserved: $data['QtyReserved'],
            freeStock: $data['FreeStock'],
            productId: $data['ProductId'],
            qty: $data['Qty'],
        );
    }
}
