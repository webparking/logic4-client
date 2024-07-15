<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class HRMTimeRegistrationRow
{
    public function __construct(
        public int $userId,
        public ?int $periodId,
        public ?\Carbon\Carbon $date,
        public int $activityId,
        public ?int $ITSTaskId,
        public ?int $CRMProjectId,
        public ?int $ITSIssueId,
        public ?string $description,
        public int $minutes,
        public bool $createPeriod,
        public ?int $periodeStatusId,
        public bool $rowIsAddedToPeriod,
        public ?string $exception,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            userId: $data['UserId'] ?? 0,
            periodId: $data['PeriodId'] ?? null,
            date: isset($data['Date']) ? \Carbon\Carbon::parse($data['Date']) : null,
            activityId: $data['ActivityId'] ?? 0,
            ITSTaskId: $data['ITSTaskId'] ?? null,
            CRMProjectId: $data['CRMProjectId'] ?? null,
            ITSIssueId: $data['ITSIssueId'] ?? null,
            description: $data['Description'] ?? null,
            minutes: $data['Minutes'] ?? 0,
            createPeriod: $data['CreatePeriod'] ?? false,
            periodeStatusId: $data['PeriodeStatusId'] ?? null,
            rowIsAddedToPeriod: $data['RowIsAddedToPeriod'] ?? false,
            exception: $data['Exception'] ?? null,
        );
    }
}
