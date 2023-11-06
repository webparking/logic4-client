<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class EmailUserEmailAddress
{
    public function __construct(
        public int $id,
        public ?string $fullAddress,
        public ?string $emailAddress,
        public bool $isDefaultEmailAddress,
        public ?string $emailHtmlSignature,
        public ?string $emailTextSignature,
        public ?string $name,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            fullAddress: $data['FullAddress'] ?? null,
            emailAddress: $data['EmailAddress'] ?? null,
            isDefaultEmailAddress: $data['IsDefaultEmailAddress'] ?? false,
            emailHtmlSignature: $data['EmailHtmlSignature'] ?? null,
            emailTextSignature: $data['EmailTextSignature'] ?? null,
            name: $data['Name'] ?? null,
        );
    }
}
