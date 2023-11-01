<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class TypeRoundOrderStatus
{
    public function __construct(
        public int $id,
        public ?string $value,
        public bool $enablePlanning,
        public bool $customerAgreesToDeliver,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            value: $data['Value'],
            enablePlanning: $data['EnablePlanning'],
            customerAgreesToDeliver: $data['CustomerAgreesToDeliver'],
        );
    }
}
