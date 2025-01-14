<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductStockInformationWarehouseDefaultPickLocation
{
    public function __construct(
        public int $warehouseId,
        public float $minimalStock,
        public ?float $maximumStock,
        public ?int $defaultPickLocationId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            warehouseId: $data['WarehouseId'] ?? 0,
            minimalStock: $data['MinimalStock'] ?? 0.0,
            maximumStock: $data['MaximumStock'] ?? null,
            defaultPickLocationId: $data['DefaultPickLocationId'] ?? null,
        );
    }
}
