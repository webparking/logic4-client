<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class BuyOrderDeliveryRowRead
{
    public function __construct(
        public ?float $buyPrice,
        public int $id,
        public ?string $productCode,
        public ?string $vendorCode,
        public ?string $productCodeSupplier,
        public ?int $buyOrderRowId,
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
            buyPrice: $data['BuyPrice'] ?? null,
            id: $data['Id'] ?? 0,
            productCode: $data['ProductCode'] ?? null,
            vendorCode: $data['VendorCode'] ?? null,
            productCodeSupplier: $data['ProductCodeSupplier'] ?? null,
            buyOrderRowId: $data['BuyOrderRowId'] ?? null,
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
