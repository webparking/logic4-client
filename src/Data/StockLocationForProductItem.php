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
            isDefault: $data['IsDefault'],
            location: $data['Location'],
            locationId: $data['LocationId'],
            qty: $data['Qty'],
            warehouseSortId: $data['WarehouseSortId'],
            rowSortId: $data['RowSortId'],
            columnSortId: $data['ColumnSortId'],
            locationSortId: $data['LocationSortId'],
            productId: $data['ProductId'],
        );
    }
}
