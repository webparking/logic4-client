<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class Vehicle
{
    public function __construct(
        public int $id,
        public ?string $description,
        public ?string $licensePlate,
        public ?string $startAddress,
        public ?string $startPostalCode,
        public ?string $startCity,
        public ?string $endAddress,
        public ?string $endPostalCode,
        public ?string $endCity,
        public ?int $type,
        public ?int $minutes,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            description: $data['Description'] ?? null,
            licensePlate: $data['LicensePlate'] ?? null,
            startAddress: $data['StartAddress'] ?? null,
            startPostalCode: $data['StartPostalCode'] ?? null,
            startCity: $data['StartCity'] ?? null,
            endAddress: $data['EndAddress'] ?? null,
            endPostalCode: $data['EndPostalCode'] ?? null,
            endCity: $data['EndCity'] ?? null,
            type: $data['Type'] ?? null,
            minutes: $data['Minutes'] ?? null,
        );
    }
}
