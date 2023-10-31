<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class PaymentMethod
{
    public function __construct(
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
            id: $data['Id'],
            description: $data['Description'],
            maxAmount: $data['MaxAmount'],
            selectKey: $data['SelectKey'],
        );
    }
}
