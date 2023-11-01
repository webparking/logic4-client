<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            productId: $data['ProductId'],
            productCode: $data['ProductCode'],
            buyPrice: $data['BuyPrice'],
            sellPrice: $data['SellPrice'],
            description: $data['Description'],
            useWarehouseIdForReservation: $data['UseWarehouseIdForReservation'],
            supplierProductCode: $data['Supplier_ProductCode'],
            commission: $data['Commission'],
            rowId: $data['RowId'],
            amountDelivered: $data['AmountDelivered'],
        );
    }
}
