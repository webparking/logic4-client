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
            productId: $data['ProductId'] ?? 0,
            warehouseId: $data['WarehouseId'] ?? 0,
            minimalStock: $data['MinimalStock'] ?? 0.0,
            maximumStock: $data['MaximumStock'] ?? null,
            defaultPickLocationId: $data['DefaultPickLocationId'] ?? null,
            note: $data['Note'] ?? null,
        );
    }
}
