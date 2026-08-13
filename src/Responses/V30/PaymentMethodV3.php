<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class PaymentMethodV3
{
    public function __construct(
        public int $numberOfDaysAfterPayment,
        public int $id,
        public ?string $description,
        public ?float $maxAmount,
        public ?string $selectKey,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            numberOfDaysAfterPayment: $data['NumberOfDaysAfterPayment'] ?? 0,
            id: $data['Id'] ?? 0,
            description: $data['Description'] ?? null,
            maxAmount: $data['MaxAmount'] ?? null,
            selectKey: $data['SelectKey'] ?? null,
        );
    }
}
