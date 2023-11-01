<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductStockSupplierWithActive
{
    public function __construct(
        public bool $active,
        public int $supplierId,
        public ?Carbon $productNextDelivery,
        public int $productId,
        public float $qty,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            active: $data['Active'],
            supplierId: $data['SupplierId'],
            productNextDelivery: $data['ProductNextDelivery'] ? Carbon::parse($data['ProductNextDelivery']) : null,
            productId: $data['ProductId'],
            qty: $data['Qty'],
        );
    }
}
