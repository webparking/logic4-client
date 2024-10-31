<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V12;

class ProductShiftPrice
{
    public function __construct(
        public int $qty,
        public float $buyPrice,
        public float $margin,
        public float $sellPriceExcl,
        public float $sellPriceGrossExcl,
        public ?string $description,
        public ?string $discountType,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            qty: $data['Qty'] ?? 0,
            buyPrice: $data['BuyPrice'] ?? 0.0,
            margin: $data['Margin'] ?? 0.0,
            sellPriceExcl: $data['SellPriceExcl'] ?? 0.0,
            sellPriceGrossExcl: $data['SellPriceGrossExcl'] ?? 0.0,
            description: $data['Description'] ?? null,
            discountType: $data['DiscountType'] ?? null,
        );
    }
}
