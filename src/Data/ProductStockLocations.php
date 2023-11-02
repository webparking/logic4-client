<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductStockLocations
{
    public function __construct(
        public int $locationId,
        public ?string $location,
        public int $productId,
        public float $qty,
        public float $freeStock,
        public ?int $zoneId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            locationId: $data['LocationId'] ?? 0,
            location: $data['Location'] ?? null,
            productId: $data['ProductId'] ?? 0,
            qty: $data['Qty'] ?? 0.0,
            freeStock: $data['FreeStock'] ?? 0.0,
            zoneId: $data['ZoneId'] ?? null,
        );
    }
}
