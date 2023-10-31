<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class WebshopOrderlistProduct
{
    public function __construct(
        public int $productId,
        public ?int $typeId,
        public ?int $qty,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'],
            typeId: $data['TypeId'],
            qty: $data['Qty'],
        );
    }
}
