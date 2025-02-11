<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductStockInformationWarehouseStock
{
    /** @param array<ProductStockInformationStockLocationStock> $locations */
    public function __construct(
        public int $warehouseId,
        public ?string $warehouseName,
        public float $actualStock,
        public float $freeStock,
        public ?array $locations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            warehouseId: $data['WarehouseId'] ?? 0,
            warehouseName: $data['WarehouseName'] ?? null,
            actualStock: $data['ActualStock'] ?? 0.0,
            freeStock: $data['FreeStock'] ?? 0.0,
            locations: array_map(static fn (array $item) => ProductStockInformationStockLocationStock::make($item), $data['Locations'] ?? []),
        );
    }
}
