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
            priceEx: $data['PriceEx'],
            qty: $data['Qty'],
            fromDate: $data['FromDate'] ? Carbon::parse($data['FromDate']) : null,
            toDate: $data['ToDate'] ? Carbon::parse($data['ToDate']) : null,
            productId: $data['ProductId'],
        );
    }
}
