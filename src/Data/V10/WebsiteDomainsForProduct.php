<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class WebsiteDomainsForProduct
{
    /** @param array<int> $websiteDomainIds */
    public function __construct(
        public int $productId,
        public ?array $websiteDomainIds,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            websiteDomainIds: $data['WebsiteDomainIds'] ?? null,
        );
    }
}
