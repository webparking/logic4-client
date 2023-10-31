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
            id: $data['Id'],
            description: $data['Description'],
            licensePlate: $data['LicensePlate'],
            startAddress: $data['StartAddress'],
            startPostalCode: $data['StartPostalCode'],
            startCity: $data['StartCity'],
            endAddress: $data['EndAddress'],
            endPostalCode: $data['EndPostalCode'],
            endCity: $data['EndCity'],
            type: $data['Type'],
            minutes: $data['Minutes'],
        );
    }
}
