<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class EmailMessageStatus
{
    public function __construct(
        public int $id,
        public ?string $name,
        public int $color,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            color: $data['Color'] ?? 0,
        );
    }
}
