<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class CreditorThirdPartyExternalIdentifer
{
    public function __construct(
        public int $creditorId,
        public int $typeId,
        public ?string $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            creditorId: $data['CreditorId'],
            typeId: $data['TypeId'],
            value: $data['Value'],
        );
    }
}
