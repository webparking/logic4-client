<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class Subscriber
{
    public function __construct(
        public int $id,
        public ?string $emailaddress,
        public int $globalisationId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            emailaddress: $data['Emailaddress'] ?? null,
            globalisationId: $data['GlobalisationId'] ?? 0,
        );
    }
}
