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
            id: $data['Id'],
            debtorId: $data['DebtorId'],
            creditorId: $data['CreditorId'],
            contactId: $data['ContactId'],
            startDateTime: $data['StartDateTime'] ? Carbon::parse($data['StartDateTime']) : null,
            endDateTime: $data['EndDateTime'] ? Carbon::parse($data['EndDateTime']) : null,
            allDayEvent: $data['AllDayEvent'],
            location: $data['Location'],
            agendaId: $data['AgendaId'],
            taskForUserId: $data['TaskForUserId'],
            ITSIssueId: $data['ITS_IssueId'],
            orderId: $data['OrderId'],
            CRMProjectId: $data['CRM_ProjectId'],
            plannedDeliveryId: $data['PlannedDeliveryId'],
        );
    }
}
