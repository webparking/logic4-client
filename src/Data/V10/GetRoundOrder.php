<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

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
        public ?\Carbon\Carbon $estimatedArrivalDateTime,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            orderId: $data['OrderId'] ?? null,
            ITSIssueId: $data['ITSIssueId'] ?? null,
            roundId: $data['RoundId'] ?? 0,
            remarks: $data['Remarks'] ?? null,
            statusId: $data['StatusId'] ?? 0,
            sorting: $data['Sorting'] ?? 0,
            estimatedArrivalDateTime: isset($data['EstimatedArrivalDateTime']) ? \Carbon\Carbon::parse($data['EstimatedArrivalDateTime']) : null,
        );
    }
}
