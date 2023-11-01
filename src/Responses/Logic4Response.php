<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses;

class Logic4Response
{
    /** @param array<string> $validationMessages */
    public function __construct(
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            validationMessages: $data['ValidationMessages'],
        );
    }
}
