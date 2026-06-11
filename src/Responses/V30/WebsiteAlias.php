<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class WebsiteAlias
{
    /** @param array<int> $websiteDomainIds */
    public function __construct(
        public int $id,
        public ?int $productId,
        public ?int $brandId,
        public ?int $productGroupId,
        public ?string $aliasUrl,
        public int $globalisationId,
        public ?array $websiteDomainIds,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            productId: $data['ProductId'] ?? null,
            brandId: $data['BrandId'] ?? null,
            productGroupId: $data['ProductGroupId'] ?? null,
            aliasUrl: $data['AliasUrl'] ?? null,
            globalisationId: $data['GlobalisationId'] ?? 0,
            websiteDomainIds: $data['WebsiteDomainIds'] ?? null,
        );
    }
}
