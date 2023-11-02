<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductMinimalStockNumber
{
    /** @param array<WarehouseMinimalStockNumber> $minimalStockWarehouses */
    public function __construct(
        public int $productId,
        public ?int $minimalStockForAdministrationLevel,
        public ?int $minimalStockProductLevel,
        public ?array $minimalStockWarehouses,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            minimalStockForAdministrationLevel: $data['MinimalStockForAdministrationLevel'] ?? null,
            minimalStockProductLevel: $data['MinimalStockProductLevel'] ?? null,
            minimalStockWarehouses: array_map(static fn (array $item) => WarehouseMinimalStockNumber::make($item), $data['MinimalStockWarehouses'] ?? []),
        );
    }
}
