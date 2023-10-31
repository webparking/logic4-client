<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

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
        public ?Carbon $expectedDeliveryDate,
        public float $qtyToOrder,
        public ?Carbon $orderedOnDateByDistributor,
        public ?int $orderRowId,
        public ?string $internalNote,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            buyOrderRowId: $data['BuyOrderRowId'],
            buyOrderId: $data['BuyOrderId'],
            debtorName: $data['DebtorName'],
            qtyToDeliver: $data['QtyToDeliver'],
            creditorProductCode: $data['CreditorProductCode'],
            productDesc1: $data['ProductDesc1'],
            standardAmountQTY: $data['StandardAmountQTY'],
            standardAmountQTYUnitId: $data['StandardAmountQTYUnitId'],
            repackingQty: $data['RepackingQty'],
            orderId: $data['OrderId'],
            productCode: $data['ProductCode'],
            productId: $data['ProductId'],
            price: $data['Price'],
            description: $data['Description'],
            productDesc2: $data['ProductDesc2'],
            expectedDeliveryDate: $data['ExpectedDeliveryDate'] ? Carbon::parse($data['ExpectedDeliveryDate']) : null,
            qtyToOrder: $data['QtyToOrder'],
            orderedOnDateByDistributor: $data['OrderedOnDateByDistributor'] ? Carbon::parse($data['OrderedOnDateByDistributor']) : null,
            orderRowId: $data['OrderRowId'],
            internalNote: $data['InternalNote'],
        );
    }
}
