<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class Appointment
{
    public function __construct(
        public int $id,
        public ?int $debtorId,
        public ?int $creditorId,
        public ?int $contactId,
        public ?Carbon $startDateTime,
        public ?Carbon $endDateTime,
        public bool $allDayEvent,
        public ?string $location,
        public int $agendaId,
        public ?int $taskForUserId,
        public ?int $ITSIssueId,
        public ?int $orderId,
        public ?int $CRMProjectId,
        public ?int $plannedDeliveryId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            debtorId: $data['DebtorId'] ?? null,
            creditorId: $data['CreditorId'] ?? null,
            contactId: $data['ContactId'] ?? null,
            startDateTime: isset($data['StartDateTime']) ? Carbon::parse($data['StartDateTime']) : null,
            endDateTime: isset($data['EndDateTime']) ? Carbon::parse($data['EndDateTime']) : null,
            allDayEvent: $data['AllDayEvent'] ?? false,
            location: $data['Location'] ?? null,
            agendaId: $data['AgendaId'] ?? 0,
            taskForUserId: $data['TaskForUserId'] ?? null,
            ITSIssueId: $data['ITS_IssueId'] ?? null,
            orderId: $data['OrderId'] ?? null,
            CRMProjectId: $data['CRM_ProjectId'] ?? null,
            plannedDeliveryId: $data['PlannedDeliveryId'] ?? null,
        );
    }
}
