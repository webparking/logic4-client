<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductStockControlHead
{
    /** @param array<\Webparking\Logic4Client\Data\V10\ProductStockControlRow> $rows */
    public function __construct(
        public ?\Carbon\Carbon $createdDate,
        public ?int $id,
        public ?string $locationName,
        public int $locationId,
        public ?\Carbon\Carbon $processDate,
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
            createdDate: isset($data['CreatedDate']) ? \Carbon\Carbon::parse($data['CreatedDate']) : null,
            id: $data['Id'] ?? null,
            locationName: $data['LocationName'] ?? null,
            locationId: $data['LocationId'] ?? 0,
            processDate: isset($data['ProcessDate']) ? \Carbon\Carbon::parse($data['ProcessDate']) : null,
            username: $data['Username'] ?? null,
            userId: $data['UserId'] ?? null,
            rows: array_map(static fn (array $item) => ProductStockControlRow::make($item), $data['Rows'] ?? []),
            eventLog: $data['EventLog'] ?? null,
            warehouseStockControlEmailTemplateId: $data['WarehouseStockControlEmailTemplateId'] ?? null,
        );
    }
}
