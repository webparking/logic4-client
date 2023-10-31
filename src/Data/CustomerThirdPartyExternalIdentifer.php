<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            debtorId: $data['DebtorId'],
            typeId: $data['TypeId'],
            value: $data['Value'],
        );
    }
}
