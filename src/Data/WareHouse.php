<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class WareHouse
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?int $stockLocationIdWhenBilling,
        public ?int $defaultPickStockLocationId,
        public ?int $defaultPickStockLocationIdForBuyorderDelivery,
        public ?int $warehouseStockControlEmailTemplate,
        public ?int $reservationLocationId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'],
            stockLocationIdWhenBilling: $data['StockLocationIdWhenBilling'],
            defaultPickStockLocationId: $data['DefaultPickStockLocationId'],
            defaultPickStockLocationIdForBuyorderDelivery: $data['DefaultPickStockLocationIdForBuyorderDelivery'],
            warehouseStockControlEmailTemplate: $data['WarehouseStockControlEmailTemplate'],
            reservationLocationId: $data['ReservationLocationId'],
        );
    }
}
