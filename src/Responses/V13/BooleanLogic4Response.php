<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V13;

class BooleanLogic4Response
{
    /** @param array<string> $validationMessages */
    public function __construct(
        public bool $value,
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: $data['Value'] ?? false,
            validationMessages: $data['ValidationMessages'] ?? [],
        );
    }
}
