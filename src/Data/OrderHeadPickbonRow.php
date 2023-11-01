<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            orderRowId: $data['OrderRowId'],
            productId: $data['ProductId'],
            qty: $data['Qty'],
            warehouseId: $data['WarehouseId'],
            orderHeadPickbonId: $data['OrderHeadPickbonId'],
            orderRowSorting: $data['OrderRowSorting'],
            orderHeadPickbonRowId: $data['OrderHeadPickbonRowId'],
            productGroupTypeId: $data['ProductGroupTypeId'],
        );
    }
}
