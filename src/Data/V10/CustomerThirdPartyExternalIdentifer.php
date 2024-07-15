<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class CustomerThirdPartyExternalIdentifer
{
    public function __construct(
        public int $debtorId,
        public int $typeId,
        public ?string $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            debtorId: $data['DebtorId'] ?? 0,
            typeId: $data['TypeId'] ?? 0,
            value: $data['Value'] ?? null,
        );
    }
}
