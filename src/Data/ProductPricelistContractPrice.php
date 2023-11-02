<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductPricelistContractPrice
{
    public function __construct(
        public float $priceEx,
        public int $qty,
        public ?Carbon $fromDate,
        public ?Carbon $toDate,
        public int $productId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            priceEx: $data['PriceEx'] ?? 0.0,
            qty: $data['Qty'] ?? 0,
            fromDate: isset($data['FromDate']) ? Carbon::parse($data['FromDate']) : null,
            toDate: isset($data['ToDate']) ? Carbon::parse($data['ToDate']) : null,
            productId: $data['ProductId'] ?? 0,
        );
    }
}
