<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class CRMProjectStatus
{
    public function __construct(
        public int $id,
        public ?string $name,
        public int $sorting,
        public bool $isCompleted,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            sorting: $data['Sorting'] ?? 0,
            isCompleted: $data['IsCompleted'] ?? false,
        );
    }
}
