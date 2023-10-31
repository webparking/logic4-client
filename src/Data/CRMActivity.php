<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class CRMActivity
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?Carbon $createdOnDateTime,
        public ?Carbon $dateTimeStart,
        public ?Carbon $dateTimeEnd,
        public int $createdByUserId,
        public ?string $notes,
        public ?CRMActivityStatus $status,
        public ?CRMActivityType $type,
        public ?Carbon $completedOnDateTime,
        public int $CRMProjectId,
        public ?string $CRMProjectName,
        public ?int $debtorContactId,
        public ?string $debtorContactFullName,
        public ?int $debtorId,
        public ?int $carriedOutByUserId,
        public ?string $carriedOutByUserName,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['Name'],
            createdOnDateTime: $data['CreatedOnDateTime'] ? Carbon::parse($data['CreatedOnDateTime']) : null,
            dateTimeStart: $data['DateTimeStart'] ? Carbon::parse($data['DateTimeStart']) : null,
            dateTimeEnd: $data['DateTimeEnd'] ? Carbon::parse($data['DateTimeEnd']) : null,
            createdByUserId: $data['CreatedByUserId'],
            notes: $data['Notes'],
            status: $data['Status'] ? CRMActivityStatus::make($data['Status']) : null,
            type: $data['Type'] ? CRMActivityType::make($data['Type']) : null,
            completedOnDateTime: $data['CompletedOnDateTime'] ? Carbon::parse($data['CompletedOnDateTime']) : null,
            CRMProjectId: $data['CRMProjectId'],
            CRMProjectName: $data['CRMProjectName'],
            debtorContactId: $data['DebtorContactId'],
            debtorContactFullName: $data['DebtorContactFullName'],
            debtorId: $data['DebtorId'],
            carriedOutByUserId: $data['CarriedOutByUserId'],
            carriedOutByUserName: $data['CarriedOutByUserName'],
        );
    }
}
