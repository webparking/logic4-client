<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class Ledger
{
    public function __construct(
        public int $id,
        public ?string $description,
        public int $code,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            description: $data['Description'],
            code: $data['Code'],
        );
    }
}
