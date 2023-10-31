<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            qty: $data['Qty'],
            buyPrice: $data['BuyPrice'],
            margin: $data['Margin'],
            sellPriceExcl: $data['SellPriceExcl'],
            sellPriceGrossExcl: $data['SellPriceGrossExcl'],
            description: $data['Description'],
            discountType: $data['DiscountType'],
        );
    }
}
