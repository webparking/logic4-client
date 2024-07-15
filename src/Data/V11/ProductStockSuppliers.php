<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductStockSuppliers
{
    public function __construct(
        public int $supplierId,
        public ?\Carbon\Carbon $productNextDelivery,
        public int $productId,
        public float $qty,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            supplierId: $data['SupplierId'] ?? 0,
            productNextDelivery: isset($data['ProductNextDelivery']) ? \Carbon\Carbon::parse($data['ProductNextDelivery']) : null,
            productId: $data['ProductId'] ?? 0,
            qty: $data['Qty'] ?? 0.0,
        );
    }
}
