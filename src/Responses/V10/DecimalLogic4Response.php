<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V10;

class DecimalLogic4Response
{
    /** @param array<string> $validationMessages */
    public function __construct(
        public float $value,
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: $data['Value'] ?? 0.0,
            validationMessages: $data['ValidationMessages'] ?? [],
        );
    }
}
