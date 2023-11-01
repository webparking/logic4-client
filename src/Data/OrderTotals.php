<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class OrderTotals
{
    public function __construct(
        public float $amountEx,
        public float $VATPercentage,
        public float $shippingCost,
        public ?float $shippingCostIncl,
        public ?float $calcTotalPayed,
        public float $amountIncl,
        public bool $isPaid,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            amountEx: $data['AmountEx'],
            VATPercentage: $data['VATPercentage'],
            shippingCost: $data['ShippingCost'],
            shippingCostIncl: $data['ShippingCostIncl'],
            calcTotalPayed: $data['Calc_TotalPayed'],
            amountIncl: $data['AmountIncl'],
            isPaid: $data['IsPaid'],
        );
    }
}
