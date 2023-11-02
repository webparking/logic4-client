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
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            stockLocationIdWhenBilling: $data['StockLocationIdWhenBilling'] ?? null,
            defaultPickStockLocationId: $data['DefaultPickStockLocationId'] ?? null,
            defaultPickStockLocationIdForBuyorderDelivery: $data['DefaultPickStockLocationIdForBuyorderDelivery'] ?? null,
            warehouseStockControlEmailTemplate: $data['WarehouseStockControlEmailTemplate'] ?? null,
            reservationLocationId: $data['ReservationLocationId'] ?? null,
        );
    }
}
