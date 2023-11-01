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
            locationId: $data['LocationId'],
            location: $data['Location'],
            productId: $data['ProductId'],
            qty: $data['Qty'],
            freeStock: $data['FreeStock'],
            zoneId: $data['ZoneId'],
        );
    }
}
