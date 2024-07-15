<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class Int32DecimalKeyValuePair
{
    public function __construct(
        public int $key,
        public float $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            key: $data['Key'] ?? 0,
            value: $data['Value'] ?? 0.0,
        );
    }
}
