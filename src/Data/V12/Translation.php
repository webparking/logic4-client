<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V12;

class Translation
{
    public function __construct(
        public ?string $globalisationCode,
        public int $globalisationId,
        public ?string $value,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            globalisationCode: $data['GlobalisationCode'] ?? null,
            globalisationId: $data['GlobalisationId'] ?? 0,
            value: $data['Value'] ?? null,
        );
    }
}
