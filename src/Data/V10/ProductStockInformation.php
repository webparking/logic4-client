<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductStockInformation
{
    /** @param array<ProductStockLocations> $stockLocations */
    public function __construct(
        public float $totalStock,
        public float $reservedStock,
        public float $freeStock,
        public ?array $stockLocations,
        public ?\Carbon\Carbon $nextDelivery,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            totalStock: $data['TotalStock'] ?? 0.0,
            reservedStock: $data['ReservedStock'] ?? 0.0,
            freeStock: $data['FreeStock'] ?? 0.0,
            stockLocations: array_map(static fn (array $item) => ProductStockLocations::make($item), $data['StockLocations'] ?? []),
            nextDelivery: isset($data['NextDelivery']) ? \Carbon\Carbon::parse($data['NextDelivery']) : null,
        );
    }
}
