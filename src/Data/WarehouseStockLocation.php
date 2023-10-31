<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class WarehouseStockLocation
{
    public function __construct(
        public int $id,
        public ?string $name,
        public int $sortId,
        public bool $blockLocationForStockIncrease,
        public bool $blockLocationForStockDecrease,
        public int $databaseAdministration,
        public int $warehouseColumnId,
        public int $warehouseColumnSortId,
        public int $warehouseRowId,
        public int $warehouseRowSortId,
        public int $warehouseId,
        public int $warehouseSortId,
        public ?int $warehouseLocationZoneId,
        public ?int $warehouseColumnZoneId,
        public ?int $warehouseRowZoneId,
        public ?string $remarks,
        public ?string $locationName,
        public int $stockType,
        public ?string $columnName,
        public ?string $rowName,
        public ?string $warehouseName,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'],
            sortId: $data['SortId'],
            blockLocationForStockIncrease: $data['BlockLocationForStockIncrease'],
            blockLocationForStockDecrease: $data['BlockLocationForStockDecrease'],
            databaseAdministration: $data['DatabaseAdministration'],
            warehouseColumnId: $data['WarehouseColumnId'],
            warehouseColumnSortId: $data['WarehouseColumnSortId'],
            warehouseRowId: $data['WarehouseRowId'],
            warehouseRowSortId: $data['WarehouseRowSortId'],
            warehouseId: $data['WarehouseId'],
            warehouseSortId: $data['WarehouseSortId'],
            warehouseLocationZoneId: $data['WarehouseLocationZoneId'],
            warehouseColumnZoneId: $data['WarehouseColumnZoneId'],
            warehouseRowZoneId: $data['WarehouseRowZoneId'],
            remarks: $data['Remarks'],
            locationName: $data['LocationName'],
            stockType: $data['StockType'],
            columnName: $data['ColumnName'],
            rowName: $data['RowName'],
            warehouseName: $data['WarehouseName'],
        );
    }
}
