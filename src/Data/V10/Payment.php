<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class Payment
{
    public function __construct(
        public ?int $orderId,
        public ?int $invoiceId,
        public float $amountIncl,
        public string $description,
        public int $bookingId,
        public int $matchingLedgerId,
        public ?\Carbon\Carbon $dateTime,
        public ?int $ledgerCode,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            orderId: $data['OrderId'] ?? null,
            invoiceId: $data['InvoiceId'] ?? null,
            amountIncl: $data['AmountIncl'] ?? 0.0,
            description: $data['Description'] ?? '',
            bookingId: $data['BookingId'] ?? 0,
            matchingLedgerId: $data['MatchingLedgerId'] ?? 0,
            dateTime: isset($data['DateTime']) ? \Carbon\Carbon::parse($data['DateTime']) : null,
            ledgerCode: $data['LedgerCode'] ?? null,
        );
    }
}
