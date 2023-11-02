<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductPickLocationBasedOnSystemSettings
{
    public function __construct(
        public int $productId,
        public ?int $defaultPickLocationId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            defaultPickLocationId: $data['DefaultPickLocationId'] ?? null,
        );
    }
}
