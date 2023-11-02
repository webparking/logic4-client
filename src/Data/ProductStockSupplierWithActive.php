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
            active: $data['Active'] ?? false,
            supplierId: $data['SupplierId'] ?? 0,
            productNextDelivery: isset($data['ProductNextDelivery']) ? Carbon::parse($data['ProductNextDelivery']) : null,
            productId: $data['ProductId'] ?? 0,
            qty: $data['Qty'] ?? 0.0,
        );
    }
}
