<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class OrderHeadPickbon
{
    public function __construct(
        public bool $isProcessed,
        public ?Carbon $orderDate,
        public ?Carbon $pickbonDateTimePrinted,
        public int $amountRows,
        public float $amountItemsToPick,
        public int $debtorId,
        public int $orderHeadPickbonId,
        public int $orderId,
        public ?string $deliveryCompanyName,
        public ?Carbon $deliveryExpDate,
        public ?string $deliveryContactName,
        public ?string $deliveryAddress,
        public ?string $deliveryAddress2,
        public ?string $deliveryCity,
        public ?string $deliveryTelephone,
        public ?string $deliveryZipcode,
        public ?Carbon $softBlockedAt,
        public ?string $softBlockedBy,
        public ?int $zoneId,
        public ?Carbon $lastReprintedOn,
        public ?int $lastReprintedByUserId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            isProcessed: $data['IsProcessed'],
            orderDate: $data['OrderDate'] ? Carbon::parse($data['OrderDate']) : null,
            pickbonDateTimePrinted: $data['PickbonDateTimePrinted'] ? Carbon::parse($data['PickbonDateTimePrinted']) : null,
            amountRows: $data['AmountRows'],
            amountItemsToPick: $data['AmountItemsToPick'],
            debtorId: $data['DebtorId'],
            orderHeadPickbonId: $data['OrderHeadPickbonId'],
            orderId: $data['OrderId'],
            deliveryCompanyName: $data['Delivery_CompanyName'],
            deliveryExpDate: $data['DeliveryExpDate'] ? Carbon::parse($data['DeliveryExpDate']) : null,
            deliveryContactName: $data['Delivery_ContactName'],
            deliveryAddress: $data['Delivery_Address'],
            deliveryAddress2: $data['Delivery_Address2'],
            deliveryCity: $data['Delivery_City'],
            deliveryTelephone: $data['Delivery_Telephone'],
            deliveryZipcode: $data['Delivery_Zipcode'],
            softBlockedAt: $data['SoftBlockedAt'] ? Carbon::parse($data['SoftBlockedAt']) : null,
            softBlockedBy: $data['SoftBlockedBy'],
            zoneId: $data['ZoneId'],
            lastReprintedOn: $data['LastReprintedOn'] ? Carbon::parse($data['LastReprintedOn']) : null,
            lastReprintedByUserId: $data['LastReprintedByUserId'],
        );
    }
}
