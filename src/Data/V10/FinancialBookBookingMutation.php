<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class FinancialBookBookingMutation
{
    /** @param array<FinancialBookBookingMutationMatching> $matchings */
    public function __construct(
        public ?\Carbon\Carbon $bookingDateTime,
        public float $amountIncl,
        public ?int $creditorId,
        public ?int $debtorId,
        public ?int $paymentMethodId,
        public ?\Carbon\Carbon $dateTimeCreated,
        public ?array $matchings,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            bookingDateTime: isset($data['BookingDateTime']) ? \Carbon\Carbon::parse($data['BookingDateTime']) : null,
            amountIncl: $data['AmountIncl'] ?? 0.0,
            creditorId: $data['CreditorId'] ?? null,
            debtorId: $data['DebtorId'] ?? null,
            paymentMethodId: $data['PaymentMethodId'] ?? null,
            dateTimeCreated: isset($data['DateTimeCreated']) ? \Carbon\Carbon::parse($data['DateTimeCreated']) : null,
            matchings: array_map(static fn (array $item) => FinancialBookBookingMutationMatching::make($item), $data['Matchings'] ?? []),
        );
    }
}
