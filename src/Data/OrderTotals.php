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
            amountEx: $data['AmountEx'] ?? 0.0,
            VATPercentage: $data['VATPercentage'] ?? 0.0,
            shippingCost: $data['ShippingCost'] ?? 0.0,
            shippingCostIncl: $data['ShippingCostIncl'] ?? null,
            calcTotalPayed: $data['Calc_TotalPayed'] ?? null,
            amountIncl: $data['AmountIncl'] ?? 0.0,
            isPaid: $data['IsPaid'] ?? false,
        );
    }
}
