<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class BundleDiscount
{
    public function __construct(
        public int $productCount,
        public float $discountPercent,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productCount: $data['ProductCount'] ?? 0,
            discountPercent: $data['DiscountPercent'] ?? 0.0,
        );
    }
}
