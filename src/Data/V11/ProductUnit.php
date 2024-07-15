<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductUnit
{
    public function __construct(
        public int $unitId,
        public ?string $description,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            unitId: $data['UnitId'] ?? 0,
            description: $data['Description'] ?? null,
        );
    }
}
