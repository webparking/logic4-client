<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            id: $data['Id'],
            name: $data['Name'],
            warehouseId: $data['WarehouseId'],
            warehouseName: $data['WarehouseName'],
        );
    }
}
