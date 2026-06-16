<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class StockLocationForProduct
{
    /** @param array<\Webparking\Logic4Client\Data\V30\StockLocationForProductItem> $stockLocations */
    public function __construct(
        public int $numberOfStockLocations,
        public int $productId,
        public ?array $stockLocations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            numberOfStockLocations: $data['NumberOfStockLocations'] ?? 0,
            productId: $data['ProductId'] ?? 0,
            stockLocations: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\StockLocationForProductItem::make($item), $data['StockLocations'] ?? []),
        );
    }
}
