<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductStockWarehouseWithDefaultPickLocation
{
    public function __construct(
        public int $productId,
        public int $warehouseId,
        public float $minimalStock,
        public ?float $maximumStock,
        public ?int $defaultPickLocationId,
        public ?string $note,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'],
            warehouseId: $data['WarehouseId'],
            minimalStock: $data['MinimalStock'],
            maximumStock: $data['MaximumStock'],
            defaultPickLocationId: $data['DefaultPickLocationId'],
            note: $data['Note'],
        );
    }
}
