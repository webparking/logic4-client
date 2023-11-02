<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class DebtorCostCentre
{
    public function __construct(
        public int $id,
        public ?string $code,
        public ?string $description,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            code: $data['Code'] ?? null,
            description: $data['Description'] ?? null,
        );
    }
}
