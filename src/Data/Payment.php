<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class Payment
{
    public function __construct(
        public ?int $orderId,
        public ?int $invoiceId,
        public float $amountIncl,
        public string $description,
        public int $bookingId,
        public int $matchingLedgerId,
        public ?Carbon $dateTime,
        public ?int $ledgerCode,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            orderId: $data['OrderId'],
            invoiceId: $data['InvoiceId'],
            amountIncl: $data['AmountIncl'],
            description: $data['Description'],
            bookingId: $data['BookingId'],
            matchingLedgerId: $data['MatchingLedgerId'],
            dateTime: $data['DateTime'] ? Carbon::parse($data['DateTime']) : null,
            ledgerCode: $data['LedgerCode'],
        );
    }
}
