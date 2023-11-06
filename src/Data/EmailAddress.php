<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class EmailAddress
{
    public function __construct(
        public ?string $name,
        public ?string $email,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            name: $data['Name'] ?? null,
            email: $data['Email'] ?? null,
        );
    }
}
