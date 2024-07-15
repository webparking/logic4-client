<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

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
            warehouseId: $data['WarehouseId'] ?? 0,
            warehouseName: $data['WarehouseName'] ?? null,
            minimalStock: $data['MinimalStock'] ?? 0.0,
            maxStock: $data['MaxStock'] ?? null,
            defaultStockLocationId: $data['DefaultStockLocationId'] ?? null,
        );
    }
}
