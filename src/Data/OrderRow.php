<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class OrderRow
{
    /** @param array<string> $serialNumbers */
    public function __construct(
        public ?array $serialNumbers,
        public ?float $expectedNextQtyOnDelivery,
        public ?float $discountPercent,
        public float $qtyReserved,
        public float $inclPrice,
        public ?string $internalNotes,
        public bool $isAssemblyChild,
        public ?int $packingMaterialDepositId,
        public ?int $id,
        public ?string $description,
        public ?string $description2,
        public ?int $productId,
        public float $qty,
        public ?float $buyPrice,
        public ?float $grossPrice,
        public ?float $nettPrice,
        public float $qtyDeliverd,
        public float $qtyDeliverdNotInvoiced,
        public ?string $productCode,
        public ?string $productBarcode1,
        public ?float $VATPercentage,
        public ?string $notes,
        public int $debtorId,
        public ?int $orderId,
        public ?int $warehouseId,
        public ?string $commission,
        public ?int $deliveryOptionId,
        public ?int $vatCodeId,
        public ?int $vatCodeIdOverrule,
        public ?string $freeValue1,
        public ?string $freeValue2,
        public ?string $freeValue3,
        public ?string $freeValue4,
        public ?string $freeValue5,
        public ?Carbon $expectedNextDelivery,
        public ?ExternalValue $externalValue,
        public ?Carbon $agreedDeliveryDate,
        public ?int $type1Id,
        public ?int $type2Id,
        public ?int $type3Id,
        public ?int $type4Id,
        public ?int $type5Id,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            serialNumbers: $data['SerialNumbers'] ?? null,
            expectedNextQtyOnDelivery: $data['ExpectedNextQtyOnDelivery'] ?? null,
            discountPercent: $data['DiscountPercent'] ?? null,
            qtyReserved: $data['QtyReserved'] ?? 0.0,
            inclPrice: $data['InclPrice'] ?? 0.0,
            internalNotes: $data['InternalNotes'] ?? null,
            isAssemblyChild: $data['IsAssemblyChild'] ?? false,
            packingMaterialDepositId: $data['PackingMaterialDepositId'] ?? null,
            id: $data['Id'] ?? null,
            description: $data['Description'] ?? null,
            description2: $data['Description2'] ?? null,
            productId: $data['ProductId'] ?? null,
            qty: $data['Qty'] ?? 0.0,
            buyPrice: $data['BuyPrice'] ?? null,
            grossPrice: $data['GrossPrice'] ?? null,
            nettPrice: $data['NettPrice'] ?? null,
            qtyDeliverd: $data['QtyDeliverd'] ?? 0.0,
            qtyDeliverdNotInvoiced: $data['QtyDeliverd_NotInvoiced'] ?? 0.0,
            productCode: $data['ProductCode'] ?? null,
            productBarcode1: $data['ProductBarcode1'] ?? null,
            VATPercentage: $data['VATPercentage'] ?? null,
            notes: $data['Notes'] ?? null,
            debtorId: $data['DebtorId'] ?? 0,
            orderId: $data['OrderId'] ?? null,
            warehouseId: $data['WarehouseId'] ?? null,
            commission: $data['Commission'] ?? null,
            deliveryOptionId: $data['DeliveryOptionId'] ?? null,
            vatCodeId: $data['VatCodeId'] ?? null,
            vatCodeIdOverrule: $data['VatCodeIdOverrule'] ?? null,
            freeValue1: $data['FreeValue1'] ?? null,
            freeValue2: $data['FreeValue2'] ?? null,
            freeValue3: $data['FreeValue3'] ?? null,
            freeValue4: $data['FreeValue4'] ?? null,
            freeValue5: $data['FreeValue5'] ?? null,
            expectedNextDelivery: isset($data['ExpectedNextDelivery']) ? Carbon::parse($data['ExpectedNextDelivery']) : null,
            externalValue: isset($data['ExternalValue']) ? ExternalValue::make($data['ExternalValue']) : null,
            agreedDeliveryDate: isset($data['AgreedDeliveryDate']) ? Carbon::parse($data['AgreedDeliveryDate']) : null,
            type1Id: $data['Type1Id'] ?? null,
            type2Id: $data['Type2Id'] ?? null,
            type3Id: $data['Type3Id'] ?? null,
            type4Id: $data['Type4Id'] ?? null,
            type5Id: $data['Type5Id'] ?? null,
        );
    }
}
