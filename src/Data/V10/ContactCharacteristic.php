<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ContactCharacteristic
{
    public function __construct(
        public int $contactId,
        public ?int $debtorId,
        public string $contactType,
        public ?string $relationCharacteristic,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            contactId: $data['ContactId'] ?? 0,
            debtorId: $data['DebtorId'] ?? null,
            contactType: $data['ContactType'] ?? '',
            relationCharacteristic: $data['RelationCharacteristic'] ?? null,
        );
    }
}
