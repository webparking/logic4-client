<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class StockLocationForProductItem
{
    public function __construct(
        public bool $isDefault,
        public ?string $location,
        public int $locationId,
        public float $qty,
        public int $warehouseSortId,
        public int $rowSortId,
        public int $columnSortId,
        public int $locationSortId,
        public int $productId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            isDefault: $data['IsDefault'] ?? false,
            location: $data['Location'] ?? null,
            locationId: $data['LocationId'] ?? 0,
            qty: $data['Qty'] ?? 0.0,
            warehouseSortId: $data['WarehouseSortId'] ?? 0,
            rowSortId: $data['RowSortId'] ?? 0,
            columnSortId: $data['ColumnSortId'] ?? 0,
            locationSortId: $data['LocationSortId'] ?? 0,
            productId: $data['ProductId'] ?? 0,
        );
    }
}
