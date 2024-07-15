<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class TypeLedgerColumn
{
    public function __construct(
        public int $id,
        public ?string $value,
        public int $sortId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            value: $data['Value'] ?? null,
            sortId: $data['SortId'] ?? 0,
        );
    }
}
