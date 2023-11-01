<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class SalesOrderDelivery
{
    /** @param array<SalesOrderDeliveryDetailRow> $details */
    public function __construct(
        public ?int $orderId,
        public int $orderStatusId,
        public ?Carbon $deliveryDate,
        public int $debtorId,
        public int $shippingMethodId,
        public ?int $branchId,
        public ?int $websiteDomainId,
        public ?array $details,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            orderId: $data['OrderId'],
            orderStatusId: $data['OrderStatusId'],
            deliveryDate: $data['DeliveryDate'] ? Carbon::parse($data['DeliveryDate']) : null,
            debtorId: $data['DebtorId'],
            shippingMethodId: $data['ShippingMethodId'],
            branchId: $data['BranchId'],
            websiteDomainId: $data['WebsiteDomainId'],
            details: array_map(static fn (array $item) => SalesOrderDeliveryDetailRow::make($item), $data['Details'] ?? []),
        );
    }
}
