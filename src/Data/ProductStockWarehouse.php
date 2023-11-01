<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductStockWarehouse
{
    public function __construct(
        public int $warehouseId,
        public ?string $warehouseName,
        public float $minimalStock,
        public ?float $maxStock,
        public ?int $defaultStockLocationId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            warehouseId: $data['WarehouseId'],
            warehouseName: $data['WarehouseName'],
            minimalStock: $data['MinimalStock'],
            maxStock: $data['MaxStock'],
            defaultStockLocationId: $data['DefaultStockLocationId'],
        );
    }
}
