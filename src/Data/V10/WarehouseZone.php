<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class WarehouseZone
{
    public function __construct(
        public int $id,
        public ?string $name,
        public int $warehouseId,
        public ?string $warehouseName,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            warehouseId: $data['WarehouseId'] ?? 0,
            warehouseName: $data['WarehouseName'] ?? null,
        );
    }
}
