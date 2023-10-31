<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            shipperTypeId: $data['ShipperTypeId'],
            freevalue1: $data['Freevalue1'],
            freevalue2: $data['Freevalue2'],
            freevalue3: $data['Freevalue3'],
            freevalue4: $data['Freevalue4'],
            freevalue5: $data['Freevalue5'],
        );
    }
}
