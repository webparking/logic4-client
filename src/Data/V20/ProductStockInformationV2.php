<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductStockInformationV2
{
    /**
     * @param array<\Webparking\Logic4Client\Data\V20\ProductStockInformationWarehouseDefaultPickLocation> $warehouseDefaultPickLocations
     * @param array<\Webparking\Logic4Client\Data\V20\ProductStockInformationWarehouseStock>               $stockInformation
     */
    public function __construct(
        public int $productId,
        public float $totalStock,
        public float $reservedStock,
        public float $freeStock,
        public ?array $warehouseDefaultPickLocations,
        public ?array $stockInformation,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            totalStock: $data['TotalStock'] ?? 0.0,
            reservedStock: $data['ReservedStock'] ?? 0.0,
            freeStock: $data['FreeStock'] ?? 0.0,
            warehouseDefaultPickLocations: array_map(static fn (array $item) => ProductStockInformationWarehouseDefaultPickLocation::make($item), $data['WarehouseDefaultPickLocations'] ?? []),
            stockInformation: array_map(static fn (array $item) => ProductStockInformationWarehouseStock::make($item), $data['StockInformation'] ?? []),
        );
    }
}
