<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductStockMutationTypeV11
{
    public function __construct(
        public bool $negative,
        public int $id,
        public ?string $description,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            negative: $data['Negative'] ?? false,
            id: $data['Id'] ?? 0,
            description: $data['Description'] ?? null,
        );
    }
}
