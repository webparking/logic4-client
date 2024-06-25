<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class BuyOrderDeliveryRowRead
{
    public function __construct(
        public int $id,
        public ?int $buyOrderRowId,
        public ?float $buyPrice,
        public ?string $debtorName,
        public ?int $orderId,
        public int $productId,
        public float $qtyDelivered,
        public ?string $remarks,
        public ?int $stockLocationId,
        public ?int $amountOfLabelsToPrint,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            buyOrderRowId: $data['BuyOrderRowId'] ?? null,
            buyPrice: $data['BuyPrice'] ?? null,
            debtorName: $data['DebtorName'] ?? null,
            orderId: $data['OrderId'] ?? null,
            productId: $data['ProductId'] ?? 0,
            qtyDelivered: $data['Qty_Delivered'] ?? 0.0,
            remarks: $data['Remarks'] ?? null,
            stockLocationId: $data['StockLocationId'] ?? null,
            amountOfLabelsToPrint: $data['AmountOfLabelsToPrint'] ?? null,
        );
    }
}
