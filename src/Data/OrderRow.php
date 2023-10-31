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
            serialNumbers: $data['SerialNumbers'],
            expectedNextQtyOnDelivery: $data['ExpectedNextQtyOnDelivery'],
            discountPercent: $data['DiscountPercent'],
            qtyReserved: $data['QtyReserved'],
            inclPrice: $data['InclPrice'],
            internalNotes: $data['InternalNotes'],
            isAssemblyChild: $data['IsAssemblyChild'],
            id: $data['Id'],
            description: $data['Description'],
            description2: $data['Description2'],
            productId: $data['ProductId'],
            qty: $data['Qty'],
            buyPrice: $data['BuyPrice'],
            grossPrice: $data['GrossPrice'],
            nettPrice: $data['NettPrice'],
            qtyDeliverd: $data['QtyDeliverd'],
            qtyDeliverdNotInvoiced: $data['QtyDeliverd_NotInvoiced'],
            productCode: $data['ProductCode'],
            productBarcode1: $data['ProductBarcode1'],
            VATPercentage: $data['VATPercentage'],
            notes: $data['Notes'],
            debtorId: $data['DebtorId'],
            orderId: $data['OrderId'],
            warehouseId: $data['WarehouseId'],
            commission: $data['Commission'],
            deliveryOptionId: $data['DeliveryOptionId'],
            vatCodeId: $data['VatCodeId'],
            vatCodeIdOverrule: $data['VatCodeIdOverrule'],
            freeValue1: $data['FreeValue1'],
            freeValue2: $data['FreeValue2'],
            freeValue3: $data['FreeValue3'],
            freeValue4: $data['FreeValue4'],
            freeValue5: $data['FreeValue5'],
            expectedNextDelivery: $data['ExpectedNextDelivery'] ? Carbon::parse($data['ExpectedNextDelivery']) : null,
            externalValue: $data['ExternalValue'] ? ExternalValue::make($data['ExternalValue']) : null,
            agreedDeliveryDate: $data['AgreedDeliveryDate'] ? Carbon::parse($data['AgreedDeliveryDate']) : null,
            type1Id: $data['Type1Id'],
            type2Id: $data['Type2Id'],
            type3Id: $data['Type3Id'],
            type4Id: $data['Type4Id'],
            type5Id: $data['Type5Id'],
        );
    }
}
