<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ITSPriority
{
    public function __construct(
        public int $id,
        public ?string $name,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
        );
    }
}
