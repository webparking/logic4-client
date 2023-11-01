<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductSupplier
{
    /** @param array<Int32DecimalKeyValuePair> $creditorBuyPrices */
    public function __construct(
        public int $productId,
        public ?string $creditorName,
        public ?string $creditorProductCode,
        public bool $isActive,
        public int $creditorId,
        public ?array $creditorBuyPrices,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'],
            creditorName: $data['CreditorName'],
            creditorProductCode: $data['CreditorProductCode'],
            isActive: $data['IsActive'],
            creditorId: $data['CreditorId'],
            creditorBuyPrices: array_map(static fn (array $item) => Int32DecimalKeyValuePair::make($item), $data['CreditorBuyPrices'] ?? []),
        );
    }
}
