<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class GetRoundOrder
{
    public function __construct(
        public int $id,
        public ?int $orderId,
        public ?int $ITSIssueId,
        public int $roundId,
        public ?string $remarks,
        public int $statusId,
        public int $sorting,
        public ?Carbon $estimatedArrivalDateTime,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            orderId: $data['OrderId'],
            ITSIssueId: $data['ITSIssueId'],
            roundId: $data['RoundId'],
            remarks: $data['Remarks'],
            statusId: $data['StatusId'],
            sorting: $data['Sorting'],
            estimatedArrivalDateTime: $data['EstimatedArrivalDateTime'] ? Carbon::parse($data['EstimatedArrivalDateTime']) : null,
        );
    }
}
