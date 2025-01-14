<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductStockInformationStockLocationStock
{
    public function __construct(
        public int $locationId,
        public float $actualStock,
        public ?int $zoneId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            locationId: $data['LocationId'] ?? 0,
            actualStock: $data['ActualStock'] ?? 0.0,
            zoneId: $data['ZoneId'] ?? null,
        );
    }
}
