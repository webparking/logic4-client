<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class DebtorCharacteristic
{
    public function __construct(
        public int $debtorId,
        public ?string $relationCharacteristic,
        public ?string $representative,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            debtorId: $data['DebtorId'] ?? 0,
            relationCharacteristic: $data['RelationCharacteristic'] ?? null,
            representative: $data['Representative'] ?? null,
        );
    }
}
