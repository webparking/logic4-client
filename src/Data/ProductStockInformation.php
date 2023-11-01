<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductStockInformation
{
    /** @param array<ProductStockLocations> $stockLocations */
    public function __construct(
        public float $totalStock,
        public float $reservedStock,
        public float $freeStock,
        public ?array $stockLocations,
        public ?Carbon $nextDelivery,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            totalStock: $data['TotalStock'],
            reservedStock: $data['ReservedStock'],
            freeStock: $data['FreeStock'],
            stockLocations: array_map(static fn (array $item) => ProductStockLocations::make($item), $data['StockLocations'] ?? []),
            nextDelivery: $data['NextDelivery'] ? Carbon::parse($data['NextDelivery']) : null,
        );
    }
}
