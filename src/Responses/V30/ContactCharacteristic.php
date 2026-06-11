<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class ContactCharacteristic
{
    public function __construct(
        public int $contactId,
        public ?int $debtorId,
        public ?\Webparking\Logic4Client\Data\V30\ContactTypeEnum $contactType,
        public ?string $relationCharacteristic,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            contactId: $data['ContactId'] ?? 0,
            debtorId: $data['DebtorId'] ?? null,
            contactType: isset($data['ContactType']) ? \Webparking\Logic4Client\Data\V30\ContactTypeEnum::make($data['ContactType']) : null,
            relationCharacteristic: $data['RelationCharacteristic'] ?? null,
        );
    }
}
