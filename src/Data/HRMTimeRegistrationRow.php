<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class HRMTimeRegistrationRow
{
    public function __construct(
        public int $userId,
        public ?int $periodId,
        public ?Carbon $date,
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
            periodId: $data['PeriodId'],
            date: $data['Date'] ? Carbon::parse($data['Date']) : null,
            activityId: $data['ActivityId'],
            ITSTaskId: $data['ITSTaskId'],
            CRMProjectId: $data['CRMProjectId'],
            ITSIssueId: $data['ITSIssueId'],
            description: $data['Description'],
            minutes: $data['Minutes'],
            createPeriod: $data['CreatePeriod'],
            periodeStatusId: $data['PeriodeStatusId'],
            rowIsAddedToPeriod: $data['RowIsAddedToPeriod'],
            exception: $data['Exception'],
        );
    }
}
