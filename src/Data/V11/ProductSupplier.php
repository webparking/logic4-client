<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductSupplier
{
    /** @param array<KeyValuePairOfintAnddecimal> $creditorBuyPrices */
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
            productId: $data['ProductId'] ?? 0,
            creditorName: $data['CreditorName'] ?? null,
            creditorProductCode: $data['CreditorProductCode'] ?? null,
            isActive: $data['IsActive'] ?? false,
            creditorId: $data['CreditorId'] ?? 0,
            creditorBuyPrices: array_map(static fn (array $item) => KeyValuePairOfintAnddecimal::make($item), $data['CreditorBuyPrices'] ?? []),
        );
    }
}
