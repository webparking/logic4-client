<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductPricelist
{
    /**
     * @param array<integer>                       $debtorIds
     * @param array<ProductPricelistContractPrice> $contractPrices
     */
    public function __construct(
        public int $id,
        public ?string $name,
        public ?array $debtorIds,
        public ?float $fixedDiscount,
        public ?array $contractPrices,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'],
            debtorIds: $data['DebtorIds'],
            fixedDiscount: $data['FixedDiscount'],
            contractPrices: array_map(static fn (array $item) => ProductPricelistContractPrice::make($item), $data['ContractPrices'] ?? []),
        );
    }
}
