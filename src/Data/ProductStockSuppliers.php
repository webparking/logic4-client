<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductStockSuppliers
{
    public function __construct(
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
            supplierId: $data['SupplierId'],
            productNextDelivery: $data['ProductNextDelivery'] ? Carbon::parse($data['ProductNextDelivery']) : null,
            productId: $data['ProductId'],
            qty: $data['Qty'],
        );
    }
}
