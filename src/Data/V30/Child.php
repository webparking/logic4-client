<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V30;

class Child
{
    public function __construct(
        public int $productId,
        public int $sortId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            sortId: $data['SortId'] ?? 0,
        );
    }
}
