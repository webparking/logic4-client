<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class FinancialJournalStatus
{
    public function __construct(
        public int $id,
        public ?string $value,
        public bool $blockPayment,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            value: $data['Value'] ?? null,
            blockPayment: $data['BlockPayment'] ?? false,
        );
    }
}
