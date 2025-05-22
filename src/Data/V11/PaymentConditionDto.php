<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class PaymentConditionDto
{
    public function __construct(
        public ?int $id,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? null,
        );
    }
}
