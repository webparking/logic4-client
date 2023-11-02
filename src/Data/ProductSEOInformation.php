<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductSEOInformation
{
    public function __construct(
        public ?int $websiteDomainId,
        public ?int $globalizationId,
        public int $productId,
        public ?string $title,
        public ?string $description,
        public ?string $USP,
        public ?string $metaName,
        public ?string $metaDescription,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
            globalizationId: $data['GlobalizationId'] ?? null,
            productId: $data['ProductId'] ?? 0,
            title: $data['Title'] ?? null,
            description: $data['Description'] ?? null,
            USP: $data['USP'] ?? null,
            metaName: $data['MetaName'] ?? null,
            metaDescription: $data['MetaDescription'] ?? null,
        );
    }
}
