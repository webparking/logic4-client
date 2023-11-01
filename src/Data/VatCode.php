<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class VatCode
{
    public function __construct(
        public int $id,
        public float $percent,
        public ?string $name,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            percent: $data['Percent'],
            name: $data['Name'],
        );
    }
}
