<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class DeliveryOption
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?string $code,
        public bool $isPickupLocation,
        public int $shipperTypeId,
        public ?string $externalTypeValue,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'],
            code: $data['Code'],
            isPickupLocation: $data['IsPickupLocation'],
            shipperTypeId: $data['ShipperTypeId'],
            externalTypeValue: $data['ExternalTypeValue'],
        );
    }
}
