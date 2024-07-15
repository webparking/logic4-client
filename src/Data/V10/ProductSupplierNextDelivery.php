<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductSupplierNextDelivery
{
    public function __construct(
        public int $productId,
        public int $supplierId,
        public ?\Carbon\Carbon $deliveryDate,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            supplierId: $data['SupplierId'] ?? 0,
            deliveryDate: isset($data['DeliveryDate']) ? \Carbon\Carbon::parse($data['DeliveryDate']) : null,
        );
    }
}
