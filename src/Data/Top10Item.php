<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class Top10Item
{
    public function __construct(
        public ?string $id,
        public ?string $name,
        public float $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'],
            value: $data['Value'],
        );
    }
}
