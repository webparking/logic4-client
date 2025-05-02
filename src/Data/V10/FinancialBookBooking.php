<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class FinancialBookBooking
{
    /** @param array<FinancialBookBookingMutation> $mutations */
    public function __construct(
        public int $bookingId,
        public int $financialBookId,
        public ?\Carbon\Carbon $bookingDateTime,
        public ?string $reference,
        public ?\Carbon\Carbon $dateTimeCreated,
        public int $userId,
        public int $bookingNumberByUser,
        public ?string $description,
        public ?int $statusId,
        public ?int $financialCostCenterId,
        public ?string $freeValue1,
        public ?string $freeValue2,
        public ?string $freeValue3,
        public ?array $mutations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            bookingId: $data['BookingId'] ?? 0,
            financialBookId: $data['FinancialBookId'] ?? 0,
            bookingDateTime: isset($data['BookingDateTime']) ? \Carbon\Carbon::parse($data['BookingDateTime']) : null,
            reference: $data['Reference'] ?? null,
            dateTimeCreated: isset($data['DateTimeCreated']) ? \Carbon\Carbon::parse($data['DateTimeCreated']) : null,
            userId: $data['UserId'] ?? 0,
            bookingNumberByUser: $data['BookingNumberByUser'] ?? 0,
            description: $data['Description'] ?? null,
            statusId: $data['StatusId'] ?? null,
            financialCostCenterId: $data['FinancialCostCenterId'] ?? null,
            freeValue1: $data['FreeValue1'] ?? null,
            freeValue2: $data['FreeValue2'] ?? null,
            freeValue3: $data['FreeValue3'] ?? null,
            mutations: array_map(static fn (array $item) => FinancialBookBookingMutation::make($item), $data['Mutations'] ?? []),
        );
    }
}
