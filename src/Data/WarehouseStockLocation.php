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
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            sortId: $data['SortId'] ?? 0,
            blockLocationForStockIncrease: $data['BlockLocationForStockIncrease'] ?? false,
            blockLocationForStockDecrease: $data['BlockLocationForStockDecrease'] ?? false,
            databaseAdministration: $data['DatabaseAdministration'] ?? 0,
            warehouseColumnId: $data['WarehouseColumnId'] ?? 0,
            warehouseColumnSortId: $data['WarehouseColumnSortId'] ?? 0,
            warehouseRowId: $data['WarehouseRowId'] ?? 0,
            warehouseRowSortId: $data['WarehouseRowSortId'] ?? 0,
            warehouseId: $data['WarehouseId'] ?? 0,
            warehouseSortId: $data['WarehouseSortId'] ?? 0,
            warehouseLocationZoneId: $data['WarehouseLocationZoneId'] ?? null,
            warehouseColumnZoneId: $data['WarehouseColumnZoneId'] ?? null,
            warehouseRowZoneId: $data['WarehouseRowZoneId'] ?? null,
            remarks: $data['Remarks'] ?? null,
            locationName: $data['LocationName'] ?? null,
            stockType: $data['StockType'] ?? 0,
            columnName: $data['ColumnName'] ?? null,
            rowName: $data['RowName'] ?? null,
            warehouseName: $data['WarehouseName'] ?? null,
        );
    }
}
