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
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            code: $data['Code'] ?? null,
            isPickupLocation: $data['IsPickupLocation'] ?? false,
            shipperTypeId: $data['ShipperTypeId'] ?? 0,
            externalTypeValue: $data['ExternalTypeValue'] ?? null,
        );
    }
}
