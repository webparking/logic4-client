<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class HRMTimeRegistrationRow
{
    public function __construct(
        public int $userId,
        public ?int $periodId,
        public \Carbon\Carbon $date,
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
            userId: $data['UserId'],
            periodId: $data['PeriodId'] ?? null,
            date: \Carbon\Carbon::parse($data['Date']),
            activityId: $data['ActivityId'],
            ITSTaskId: $data['ITSTaskId'] ?? null,
            CRMProjectId: $data['CRMProjectId'] ?? null,
            ITSIssueId: $data['ITSIssueId'] ?? null,
            description: $data['Description'] ?? null,
            minutes: $data['Minutes'],
            createPeriod: $data['CreatePeriod'] ?? false,
            periodeStatusId: $data['PeriodeStatusId'] ?? null,
            rowIsAddedToPeriod: $data['RowIsAddedToPeriod'] ?? false,
            exception: $data['Exception'] ?? null,
        );
    }
}
