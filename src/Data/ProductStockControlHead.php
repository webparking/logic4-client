<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductStockControlHead
{
    /** @param array<ProductStockControlRow> $rows */
    public function __construct(
        public ?Carbon $createdDate,
        public ?int $id,
        public ?string $locationName,
        public int $locationId,
        public ?Carbon $processDate,
        public ?string $username,
        public ?int $userId,
        public ?array $rows,
        public ?string $eventLog,
        public ?int $warehouseStockControlEmailTemplateId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            createdDate: $data['CreatedDate'] ? Carbon::parse($data['CreatedDate']) : null,
            id: $data['Id'],
            locationName: $data['LocationName'],
            locationId: $data['LocationId'],
            processDate: $data['ProcessDate'] ? Carbon::parse($data['ProcessDate']) : null,
            username: $data['Username'],
            userId: $data['UserId'],
            rows: array_map(static fn (array $item) => ProductStockControlRow::make($item), $data['Rows'] ?? []),
            eventLog: $data['EventLog'],
            warehouseStockControlEmailTemplateId: $data['WarehouseStockControlEmailTemplateId'],
        );
    }
}
