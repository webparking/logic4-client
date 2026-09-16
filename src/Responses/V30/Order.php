<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class Order
{
    /**
     * @param array<\Webparking\Logic4Client\Data\V30\OrderShipment> $orderShipments
     * @param array<\Webparking\Logic4Client\Data\V30\Payment>       $payments
     * @param array<\Webparking\Logic4Client\Data\V30\OrderRow>      $orderRows
     */
    public function __construct(
        public int $debtorId,
        public int $id,
        public ?\Webparking\Logic4Client\Data\V30\OrderTotalsRead $totals,
        public ?\Webparking\Logic4Client\Data\V30\PaymentMethod $paymentMethod,
        public ?\Webparking\Logic4Client\Data\V30\OrderStatus $orderStatus,
        public ?\Webparking\Logic4Client\Data\V30\OrderShippingMethod $shippingMethod,
        public ?array $orderShipments,
        public ?int $invoiceBelongsToOrderNumber,
        public ?array $payments,
        public ?\Webparking\Logic4Client\Data\V30\DebtorCostCentre $costCentre,
        public ?\Webparking\Logic4Client\Data\V30\CustomerAddress $accountAddress,
        public ?array $orderRows,
        public ?int $deliveryProvinceId,
        public ?int $invoiceProvinceId,
        public ?int $accountProvinceId,
        public ?string $lastClickGclIdValues,
        public ?string $lastClickUtmValues,
        public ?\Webparking\Logic4Client\Data\V30\CustomerAddress $deliveryAddress,
        public ?\Webparking\Logic4Client\Data\V30\CustomerAddress $invoiceAddress,
        public ?\Carbon\Carbon $creationDate,
        public ?string $description,
        public ?string $reference,
        public ?int $branchId,
        public ?int $userId,
        public ?int $websiteDomainId,
        public ?int $deliveryOptionId,
        public ?\Carbon\Carbon $deliveryDate,
        public ?\Webparking\Logic4Client\Data\V30\OrderShipmentFreeValue $orderShipmentFreeValues,
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
            debtorId: $data['DebtorId'] ?? 0,
            id: $data['Id'] ?? 0,
            totals: isset($data['Totals']) ? \Webparking\Logic4Client\Data\V30\OrderTotalsRead::make($data['Totals']) : null,
            paymentMethod: isset($data['PaymentMethod']) ? \Webparking\Logic4Client\Data\V30\PaymentMethod::make($data['PaymentMethod']) : null,
            orderStatus: isset($data['OrderStatus']) ? \Webparking\Logic4Client\Data\V30\OrderStatus::make($data['OrderStatus']) : null,
            shippingMethod: isset($data['ShippingMethod']) ? \Webparking\Logic4Client\Data\V30\OrderShippingMethod::make($data['ShippingMethod']) : null,
            orderShipments: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\OrderShipment::make($item), $data['OrderShipments'] ?? []),
            invoiceBelongsToOrderNumber: $data['InvoiceBelongsToOrderNumber'] ?? null,
            payments: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\Payment::make($item), $data['Payments'] ?? []),
            costCentre: isset($data['CostCentre']) ? \Webparking\Logic4Client\Data\V30\DebtorCostCentre::make($data['CostCentre']) : null,
            accountAddress: isset($data['AccountAddress']) ? \Webparking\Logic4Client\Data\V30\CustomerAddress::make($data['AccountAddress']) : null,
            orderRows: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\OrderRow::make($item), $data['OrderRows'] ?? []),
            deliveryProvinceId: $data['DeliveryProvinceId'] ?? null,
            invoiceProvinceId: $data['InvoiceProvinceId'] ?? null,
            accountProvinceId: $data['AccountProvinceId'] ?? null,
            lastClickGclIdValues: $data['LastClickGclIdValues'] ?? null,
            lastClickUtmValues: $data['LastClickUtmValues'] ?? null,
            deliveryAddress: isset($data['DeliveryAddress']) ? \Webparking\Logic4Client\Data\V30\CustomerAddress::make($data['DeliveryAddress']) : null,
            invoiceAddress: isset($data['InvoiceAddress']) ? \Webparking\Logic4Client\Data\V30\CustomerAddress::make($data['InvoiceAddress']) : null,
            creationDate: isset($data['CreationDate']) ? \Carbon\Carbon::parse($data['CreationDate']) : null,
            description: $data['Description'] ?? null,
            reference: $data['Reference'] ?? null,
            branchId: $data['BranchId'] ?? null,
            userId: $data['UserId'] ?? null,
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
            deliveryOptionId: $data['DeliveryOptionId'] ?? null,
            deliveryDate: isset($data['DeliveryDate']) ? \Carbon\Carbon::parse($data['DeliveryDate']) : null,
            orderShipmentFreeValues: isset($data['OrderShipmentFreeValues']) ? \Webparking\Logic4Client\Data\V30\OrderShipmentFreeValue::make($data['OrderShipmentFreeValues']) : null,
            notes: $data['Notes'] ?? null,
            freeValue1: $data['FreeValue1'] ?? null,
            freeValue2: $data['FreeValue2'] ?? null,
            freeValue3: $data['FreeValue3'] ?? null,
            freeValue4: $data['FreeValue4'] ?? null,
            freeValue5: $data['FreeValue5'] ?? null,
            freeValue6: $data['FreeValue6'] ?? null,
            freeValue7: $data['FreeValue7'] ?? null,
            freeValue8: $data['FreeValue8'] ?? null,
            orderType1Id: $data['OrderType1Id'] ?? null,
            orderType2Id: $data['OrderType2Id'] ?? null,
            orderType3Id: $data['OrderType3Id'] ?? null,
            orderType4Id: $data['OrderType4Id'] ?? null,
            orderType5Id: $data['OrderType5Id'] ?? null,
            orderType6Id: $data['OrderType6Id'] ?? null,
            orderType7Id: $data['OrderType7Id'] ?? null,
            orderType8Id: $data['OrderType8Id'] ?? null,
        );
    }
}
