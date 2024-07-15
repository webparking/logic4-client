<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class BuyOrderRow
{
    public function __construct(
        public int $buyOrderRowId,
        public int $buyOrderId,
        public ?string $debtorName,
        public float $qtyToDeliver,
        public ?string $creditorProductCode,
        public ?string $productDesc1,
        public ?float $standardAmountQTY,
        public ?int $standardAmountQTYUnitId,
        public ?int $repackingQty,
        public ?int $orderId,
        public ?string $productCode,
        public ?int $productId,
        public float $price,
        public ?string $description,
        public ?string $productDesc2,
        public ?\Carbon\Carbon $expectedDeliveryDate,
        public float $qtyToOrder,
        public ?\Carbon\Carbon $orderedOnDateByDistributor,
        public ?int $orderRowId,
        public ?string $internalNote,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            buyOrderRowId: $data['BuyOrderRowId'] ?? 0,
            buyOrderId: $data['BuyOrderId'] ?? 0,
            debtorName: $data['DebtorName'] ?? null,
            qtyToDeliver: $data['QtyToDeliver'] ?? 0.0,
            creditorProductCode: $data['CreditorProductCode'] ?? null,
            productDesc1: $data['ProductDesc1'] ?? null,
            standardAmountQTY: $data['StandardAmountQTY'] ?? null,
            standardAmountQTYUnitId: $data['StandardAmountQTYUnitId'] ?? null,
            repackingQty: $data['RepackingQty'] ?? null,
            orderId: $data['OrderId'] ?? null,
            productCode: $data['ProductCode'] ?? null,
            productId: $data['ProductId'] ?? null,
            price: $data['Price'] ?? 0.0,
            description: $data['Description'] ?? null,
            productDesc2: $data['ProductDesc2'] ?? null,
            expectedDeliveryDate: isset($data['ExpectedDeliveryDate']) ? \Carbon\Carbon::parse($data['ExpectedDeliveryDate']) : null,
            qtyToOrder: $data['QtyToOrder'] ?? 0.0,
            orderedOnDateByDistributor: isset($data['OrderedOnDateByDistributor']) ? \Carbon\Carbon::parse($data['OrderedOnDateByDistributor']) : null,
            orderRowId: $data['OrderRowId'] ?? null,
            internalNote: $data['InternalNote'] ?? null,
        );
    }
}
