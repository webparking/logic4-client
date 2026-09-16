<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class CreditorTypeDto
{
    public function __construct(
        public ?int $id,
        public ?string $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? null,
            value: $data['Value'] ?? null,
        );
    }
}
