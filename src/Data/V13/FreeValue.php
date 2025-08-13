<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V13;

class FreeValue
{
    public function __construct(
        public ?string $key,
        public ?string $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            key: $data['Key'] ?? null,
            value: $data['Value'] ?? null,
        );
    }
}
