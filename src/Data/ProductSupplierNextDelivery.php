<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductSupplierNextDelivery
{
    public function __construct(
        public int $productId,
        public int $supplierId,
        public ?Carbon $deliveryDate,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            supplierId: $data['SupplierId'] ?? 0,
            deliveryDate: isset($data['DeliveryDate']) ? Carbon::parse($data['DeliveryDate']) : null,
        );
    }
}
