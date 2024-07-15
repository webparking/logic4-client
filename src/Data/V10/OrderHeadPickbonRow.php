<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class OrderHeadPickbonRow
{
    public function __construct(
        public int $orderRowId,
        public int $productId,
        public float $qty,
        public ?int $warehouseId,
        public int $orderHeadPickbonId,
        public int $orderRowSorting,
        public int $orderHeadPickbonRowId,
        public int $productGroupTypeId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            orderRowId: $data['OrderRowId'] ?? 0,
            productId: $data['ProductId'] ?? 0,
            qty: $data['Qty'] ?? 0.0,
            warehouseId: $data['WarehouseId'] ?? null,
            orderHeadPickbonId: $data['OrderHeadPickbonId'] ?? 0,
            orderRowSorting: $data['OrderRowSorting'] ?? 0,
            orderHeadPickbonRowId: $data['OrderHeadPickbonRowId'] ?? 0,
            productGroupTypeId: $data['ProductGroupTypeId'] ?? 0,
        );
    }
}
