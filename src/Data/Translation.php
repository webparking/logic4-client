<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class Translation
{
    public function __construct(
        public ?string $globalisationCode,
        public ?string $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            globalisationCode: $data['GlobalisationCode'] ?? null,
            value: $data['Value'] ?? null,
        );
    }
}
