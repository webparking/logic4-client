<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ExternalValue
{
    public function __construct(
        public int $typeId,
        public ?string $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            typeId: $data['TypeId'],
            value: $data['Value'],
        );
    }
}
