<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductOffer
{
    public function __construct(
        public ?Carbon $startDate,
        public ?Carbon $endDate,
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
            startDate: $data['StartDate'] ? Carbon::parse($data['StartDate']) : null,
            endDate: $data['EndDate'] ? Carbon::parse($data['EndDate']) : null,
            fromPrice: $data['FromPrice'],
            toPrice: $data['ToPrice'],
            offerGroupId: $data['OfferGroupId'],
            productId: $data['ProductId'],
        );
    }
}
