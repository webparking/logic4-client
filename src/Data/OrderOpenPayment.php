<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class OrderOpenPayment
{
    public function __construct(
        public float $amount,
        public float $amountEx,
        public ?Carbon $endDate,
        public ?string $periodDescription,
        public ?float $totalPayments,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            amount: $data['Amount'],
            amountEx: $data['AmountEx'],
            endDate: $data['EndDate'] ? Carbon::parse($data['EndDate']) : null,
            periodDescription: $data['PeriodDescription'],
            totalPayments: $data['TotalPayments'],
        );
    }
}
