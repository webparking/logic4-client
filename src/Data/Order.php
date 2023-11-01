<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class Order
{
    /**
     * @param array<OrderShipment> $orderShipments
     * @param array<Payment>       $payments
     * @param array<OrderRow>      $orderRows
     */
    public function __construct(
        public int $debtorId,
        public int $id,
        public ?OrderTotals $totals,
        public ?PaymentMethod $paymentMethod,
        public ?OrderStatus $orderStatus,
        public ?OrderShippingMethod $shippingMethod,
        public ?array $orderShipments,
        public ?int $invoiceBelongsToOrderNumber,
        public ?array $payments,
        public ?DebtorCostCentre $costCentre,
        public ?CustomerAddress $accountAddress,
        public array $orderRows,
        public ?CustomerAddress $deliveryAddress,
        public ?CustomerAddress $invoiceAddress,
        public ?Carbon $creationDate,
        public ?string $description,
        public ?string $reference,
        public ?int $branchId,
        public ?int $userId,
        public ?int $websiteDomainId,
        public ?int $deliveryOptionId,
        public ?Carbon $deliveryDate,
        public ?OrderShipmentFreeValue $orderShipmentFreeValues,
        public ?string $notes,
        public ?string $freeValue1,
        public ?string $freeValue2,
        public ?string $freeValue3,
        public ?string $freeValue4,
        public ?string $freeValue5,
        public ?string $freeValue6,
        public ?string $freeValue7,
        public ?string $freeValue8,
        public ?int $orderType1Id,
        public ?int $orderType2Id,
        public ?int $orderType3Id,
        public ?int $orderType4Id,
        public ?int $orderType5Id,
        public ?int $orderType6Id,
        public ?int $orderType7Id,
        public ?int $orderType8Id,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            debtorId: $data['DebtorId'],
            id: $data['Id'],
            totals: $data['Totals'] ? OrderTotals::make($data['Totals']) : null,
            paymentMethod: $data['PaymentMethod'] ? PaymentMethod::make($data['PaymentMethod']) : null,
            orderStatus: $data['OrderStatus'] ? OrderStatus::make($data['OrderStatus']) : null,
            shippingMethod: $data['ShippingMethod'] ? OrderShippingMethod::make($data['ShippingMethod']) : null,
            orderShipments: array_map(static fn (array $item) => OrderShipment::make($item), $data['OrderShipments'] ?? []),
            invoiceBelongsToOrderNumber: $data['InvoiceBelongsToOrderNumber'],
            payments: array_map(static fn (array $item) => Payment::make($item), $data['Payments'] ?? []),
            costCentre: $data['CostCentre'] ? DebtorCostCentre::make($data['CostCentre']) : null,
            accountAddress: $data['AccountAddress'] ? CustomerAddress::make($data['AccountAddress']) : null,
            orderRows: array_map(static fn (array $item) => OrderRow::make($item), $data['OrderRows'] ?? []),
            deliveryAddress: $data['DeliveryAddress'] ? CustomerAddress::make($data['DeliveryAddress']) : null,
            invoiceAddress: $data['InvoiceAddress'] ? CustomerAddress::make($data['InvoiceAddress']) : null,
            creationDate: $data['CreationDate'] ? Carbon::parse($data['CreationDate']) : null,
            description: $data['Description'],
            reference: $data['Reference'],
            branchId: $data['BranchId'],
            userId: $data['UserId'],
            websiteDomainId: $data['WebsiteDomainId'],
            deliveryOptionId: $data['DeliveryOptionId'],
            deliveryDate: $data['DeliveryDate'] ? Carbon::parse($data['DeliveryDate']) : null,
            orderShipmentFreeValues: $data['OrderShipmentFreeValues'] ? OrderShipmentFreeValue::make($data['OrderShipmentFreeValues']) : null,
            notes: $data['Notes'],
            freeValue1: $data['FreeValue1'],
            freeValue2: $data['FreeValue2'],
            freeValue3: $data['FreeValue3'],
            freeValue4: $data['FreeValue4'],
            freeValue5: $data['FreeValue5'],
            freeValue6: $data['FreeValue6'],
            freeValue7: $data['FreeValue7'],
            freeValue8: $data['FreeValue8'],
            orderType1Id: $data['OrderType1Id'],
            orderType2Id: $data['OrderType2Id'],
            orderType3Id: $data['OrderType3Id'],
            orderType4Id: $data['OrderType4Id'],
            orderType5Id: $data['OrderType5Id'],
            orderType6Id: $data['OrderType6Id'],
            orderType7Id: $data['OrderType7Id'],
            orderType8Id: $data['OrderType8Id'],
        );
    }
}
