<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            id: $data['Id'],
            value: $data['Value'],
            sortId: $data['SortId'],
        );
    }
}
