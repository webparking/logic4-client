<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class SalesOrderDeliveryDetailRow
{
    public function __construct(
        public int $productId,
        public ?string $productCode,
        public float $buyPrice,
        public float $sellPrice,
        public ?string $description,
        public ?int $useWarehouseIdForReservation,
        public ?string $supplierProductCode,
        public ?string $commission,
        public int $rowId,
        public float $amountDelivered,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            productCode: $data['ProductCode'] ?? null,
            buyPrice: $data['BuyPrice'] ?? 0.0,
            sellPrice: $data['SellPrice'] ?? 0.0,
            description: $data['Description'] ?? null,
            useWarehouseIdForReservation: $data['UseWarehouseIdForReservation'] ?? null,
            supplierProductCode: $data['Supplier_ProductCode'] ?? null,
            commission: $data['Commission'] ?? null,
            rowId: $data['RowId'] ?? 0,
            amountDelivered: $data['AmountDelivered'] ?? 0.0,
        );
    }
}
