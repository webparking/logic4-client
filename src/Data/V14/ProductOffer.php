<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V14;

class ProductOffer
{
    public function __construct(
        public ?\Carbon\Carbon $startDate,
        public ?\Carbon\Carbon $endDate,
        public ?float $fromPrice,
        public ?float $toPrice,
        public ?int $offerGroupId,
        public int $productId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            startDate: isset($data['StartDate']) ? \Carbon\Carbon::parse($data['StartDate']) : null,
            endDate: isset($data['EndDate']) ? \Carbon\Carbon::parse($data['EndDate']) : null,
            fromPrice: $data['FromPrice'] ?? null,
            toPrice: $data['ToPrice'] ?? null,
            offerGroupId: $data['OfferGroupId'] ?? null,
            productId: $data['ProductId'] ?? 0,
        );
    }
}
