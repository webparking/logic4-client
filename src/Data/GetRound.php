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
            id: $data['Id'],
            dateTimeCreated: $data['DateTimeCreated'] ? Carbon::parse($data['DateTimeCreated']) : null,
            createdByUserId: $data['CreatedByUserId'],
            itsIds: $data['ItsIds'],
            orderIds: $data['OrderIds'],
            typeId: $data['TypeId'],
            description: $data['Description'],
            memo: $data['Memo'],
            dateTimePlanned: $data['DateTimePlanned'] ? Carbon::parse($data['DateTimePlanned']) : null,
            vehicleId: $data['VehicleId'],
            driverId: $data['DriverId'],
            coDriverId: $data['CoDriverId'],
            statusId: $data['StatusId'],
            hideInSystem: $data['HideInSystem'],
        );
    }
}
