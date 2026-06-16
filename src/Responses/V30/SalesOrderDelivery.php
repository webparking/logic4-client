<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class SalesOrderDelivery
{
    /** @param array<\Webparking\Logic4Client\Data\V30\SalesOrderDeliveryDetailRow> $details */
    public function __construct(
        public int $deliveryId,
        public ?int $orderId,
        public int $orderStatusId,
        public ?\Carbon\Carbon $deliveryDate,
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
            deliveryId: $data['DeliveryId'] ?? 0,
            orderId: $data['OrderId'] ?? null,
            orderStatusId: $data['OrderStatusId'] ?? 0,
            deliveryDate: isset($data['DeliveryDate']) ? \Carbon\Carbon::parse($data['DeliveryDate']) : null,
            debtorId: $data['DebtorId'] ?? 0,
            shippingMethodId: $data['ShippingMethodId'] ?? 0,
            branchId: $data['BranchId'] ?? null,
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
            details: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\SalesOrderDeliveryDetailRow::make($item), $data['Details'] ?? []),
        );
    }
}
