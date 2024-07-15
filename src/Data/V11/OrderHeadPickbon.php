<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class OrderHeadPickbon
{
    public function __construct(
        public bool $isProcessed,
        public ?\Carbon\Carbon $orderDate,
        public ?\Carbon\Carbon $pickbonDateTimePrinted,
        public int $amountRows,
        public float $amountItemsToPick,
        public int $debtorId,
        public int $orderHeadPickbonId,
        public int $orderId,
        public ?string $deliveryCompanyName,
        public ?\Carbon\Carbon $deliveryExpDate,
        public ?string $deliveryContactName,
        public ?string $deliveryAddress,
        public ?string $deliveryAddress2,
        public ?string $deliveryCity,
        public ?string $deliveryTelephone,
        public ?string $deliveryZipcode,
        public ?\Carbon\Carbon $softBlockedAt,
        public ?string $softBlockedBy,
        public ?int $zoneId,
        public ?\Carbon\Carbon $lastReprintedOn,
        public ?int $lastReprintedByUserId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            isProcessed: $data['IsProcessed'] ?? false,
            orderDate: isset($data['OrderDate']) ? \Carbon\Carbon::parse($data['OrderDate']) : null,
            pickbonDateTimePrinted: isset($data['PickbonDateTimePrinted']) ? \Carbon\Carbon::parse($data['PickbonDateTimePrinted']) : null,
            amountRows: $data['AmountRows'] ?? 0,
            amountItemsToPick: $data['AmountItemsToPick'] ?? 0.0,
            debtorId: $data['DebtorId'] ?? 0,
            orderHeadPickbonId: $data['OrderHeadPickbonId'] ?? 0,
            orderId: $data['OrderId'] ?? 0,
            deliveryCompanyName: $data['Delivery_CompanyName'] ?? null,
            deliveryExpDate: isset($data['DeliveryExpDate']) ? \Carbon\Carbon::parse($data['DeliveryExpDate']) : null,
            deliveryContactName: $data['Delivery_ContactName'] ?? null,
            deliveryAddress: $data['Delivery_Address'] ?? null,
            deliveryAddress2: $data['Delivery_Address2'] ?? null,
            deliveryCity: $data['Delivery_City'] ?? null,
            deliveryTelephone: $data['Delivery_Telephone'] ?? null,
            deliveryZipcode: $data['Delivery_Zipcode'] ?? null,
            softBlockedAt: isset($data['SoftBlockedAt']) ? \Carbon\Carbon::parse($data['SoftBlockedAt']) : null,
            softBlockedBy: $data['SoftBlockedBy'] ?? null,
            zoneId: $data['ZoneId'] ?? null,
            lastReprintedOn: isset($data['LastReprintedOn']) ? \Carbon\Carbon::parse($data['LastReprintedOn']) : null,
            lastReprintedByUserId: $data['LastReprintedByUserId'] ?? null,
        );
    }
}
