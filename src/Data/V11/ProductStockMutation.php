<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductStockMutation
{
    public function __construct(
        public ?string $productCode,
        public ?int $buyOrderId,
        public ?\Carbon\Carbon $mutationDateTime,
        public float $buyPrice,
        public ?string $stockMutationType,
        public ?int $ITSIssueId,
        public ?int $pickbonId,
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
            productCode: $data['ProductCode'] ?? null,
            buyOrderId: $data['BuyOrderId'] ?? null,
            mutationDateTime: isset($data['MutationDateTime']) ? \Carbon\Carbon::parse($data['MutationDateTime']) : null,
            buyPrice: $data['BuyPrice'] ?? 0.0,
            stockMutationType: $data['StockMutationType'] ?? null,
            ITSIssueId: $data['ITS_IssueId'] ?? null,
            pickbonId: $data['PickbonId'] ?? null,
            productId: $data['ProductId'] ?? 0,
            amount: $data['Amount'] ?? 0.0,
            remarks: $data['Remarks'] ?? null,
            stockLocationId: $data['StockLocationId'] ?? 0,
            stockMutationTypeId: $data['StockMutationTypeId'] ?? 0,
        );
    }
}
