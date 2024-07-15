<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V12;

class OrderShipmentFreeValue
{
    public function __construct(
        public int $shipperTypeId,
        public ?string $freevalue1,
        public ?string $freevalue2,
        public ?string $freevalue3,
        public ?string $freevalue4,
        public ?string $freevalue5,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            shipperTypeId: $data['ShipperTypeId'] ?? 0,
            freevalue1: $data['Freevalue1'] ?? null,
            freevalue2: $data['Freevalue2'] ?? null,
            freevalue3: $data['Freevalue3'] ?? null,
            freevalue4: $data['Freevalue4'] ?? null,
            freevalue5: $data['Freevalue5'] ?? null,
        );
    }
}
