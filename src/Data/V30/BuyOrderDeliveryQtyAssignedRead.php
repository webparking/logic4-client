<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V30;

class BuyOrderDeliveryQtyAssignedRead
{
    public function __construct(
        public int $buyOrderId,
        public int $productId,
        public ?string $productCode,
        public float $qtyAssigned,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            buyOrderId: $data['BuyOrderId'] ?? 0,
            productId: $data['ProductId'] ?? 0,
            productCode: $data['ProductCode'] ?? null,
            qtyAssigned: $data['Qty_Assigned'] ?? 0.0,
        );
    }
}
