<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class GlobalizationType
{
    public function __construct(
        public int $id,
        public ?string $description,
        public ?string $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            description: $data['Description'] ?? null,
            value: $data['Value'] ?? null,
        );
    }
}
