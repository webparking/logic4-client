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
            id: $data['id'] ?? 0,
            name: $data['Name'] ?? null,
            createdOnDateTime: isset($data['CreatedOnDateTime']) ? Carbon::parse($data['CreatedOnDateTime']) : null,
            dateTimeStart: isset($data['DateTimeStart']) ? Carbon::parse($data['DateTimeStart']) : null,
            dateTimeEnd: isset($data['DateTimeEnd']) ? Carbon::parse($data['DateTimeEnd']) : null,
            createdByUserId: $data['CreatedByUserId'] ?? 0,
            notes: $data['Notes'] ?? null,
            status: isset($data['Status']) ? CRMActivityStatus::make($data['Status']) : null,
            type: isset($data['Type']) ? CRMActivityType::make($data['Type']) : null,
            completedOnDateTime: isset($data['CompletedOnDateTime']) ? Carbon::parse($data['CompletedOnDateTime']) : null,
            CRMProjectId: $data['CRMProjectId'] ?? 0,
            CRMProjectName: $data['CRMProjectName'] ?? null,
            debtorContactId: $data['DebtorContactId'] ?? null,
            debtorContactFullName: $data['DebtorContactFullName'] ?? null,
            debtorId: $data['DebtorId'] ?? null,
            carriedOutByUserId: $data['CarriedOutByUserId'] ?? null,
            carriedOutByUserName: $data['CarriedOutByUserName'] ?? null,
        );
    }
}
