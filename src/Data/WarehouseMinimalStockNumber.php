<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class WarehouseMinimalStockNumber
{
    public function __construct(
        public int $warehouseId,
        public ?float $minimalStock,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            warehouseId: $data['WarehouseId'],
            minimalStock: $data['MinimalStock'],
        );
    }
}
