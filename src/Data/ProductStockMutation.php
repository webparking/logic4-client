<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductStockMutation
{
    public function __construct(
        public ?string $productCode,
        public ?int $buyOrderId,
        public ?Carbon $mutationDateTime,
        public float $buyPrice,
        public ?string $stockMutationType,
        public ?int $ITSIssueId,
        public int $productId,
        public float $amount,
        public ?string $remarks,
        public int $stockLocationId,
        public int $stockMutationTypeId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productCode: $data['ProductCode'],
            buyOrderId: $data['BuyOrderId'],
            mutationDateTime: $data['MutationDateTime'] ? Carbon::parse($data['MutationDateTime']) : null,
            buyPrice: $data['BuyPrice'],
            stockMutationType: $data['StockMutationType'],
            ITSIssueId: $data['ITS_IssueId'],
            productId: $data['ProductId'],
            amount: $data['Amount'],
            remarks: $data['Remarks'],
            stockLocationId: $data['StockLocationId'],
            stockMutationTypeId: $data['StockMutationTypeId'],
        );
    }
}
