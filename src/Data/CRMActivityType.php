<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class CRMActivityType
{
    public function __construct(
        public int $id,
        public ?string $description,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            description: $data['Description'] ?? null,
        );
    }
}
