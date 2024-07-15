<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductPricelistContractPrice
{
    public function __construct(
        public float $priceEx,
        public int $qty,
        public ?\Carbon\Carbon $fromDate,
        public ?\Carbon\Carbon $toDate,
        public int $productId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            priceEx: $data['PriceEx'] ?? 0.0,
            qty: $data['Qty'] ?? 0,
            fromDate: isset($data['FromDate']) ? \Carbon\Carbon::parse($data['FromDate']) : null,
            toDate: isset($data['ToDate']) ? \Carbon\Carbon::parse($data['ToDate']) : null,
            productId: $data['ProductId'] ?? 0,
        );
    }
}
