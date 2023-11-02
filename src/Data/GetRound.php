<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class GetRound
{
    /**
     * @param array<integer> $itsIds
     * @param array<integer> $orderIds
     */
    public function __construct(
        public int $id,
        public ?Carbon $dateTimeCreated,
        public int $createdByUserId,
        public ?array $itsIds,
        public ?array $orderIds,
        public int $typeId,
        public ?string $description,
        public ?string $memo,
        public ?Carbon $dateTimePlanned,
        public ?int $vehicleId,
        public ?int $driverId,
        public ?int $coDriverId,
        public int $statusId,
        public bool $hideInSystem,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            dateTimeCreated: isset($data['DateTimeCreated']) ? Carbon::parse($data['DateTimeCreated']) : null,
            createdByUserId: $data['CreatedByUserId'] ?? 0,
            itsIds: $data['ItsIds'] ?? null,
            orderIds: $data['OrderIds'] ?? null,
            typeId: $data['TypeId'] ?? 0,
            description: $data['Description'] ?? null,
            memo: $data['Memo'] ?? null,
            dateTimePlanned: isset($data['DateTimePlanned']) ? Carbon::parse($data['DateTimePlanned']) : null,
            vehicleId: $data['VehicleId'] ?? null,
            driverId: $data['DriverId'] ?? null,
            coDriverId: $data['CoDriverId'] ?? null,
            statusId: $data['StatusId'] ?? 0,
            hideInSystem: $data['HideInSystem'] ?? false,
        );
    }
}
