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
            websiteDomainId: $data['WebsiteDomainId'],
            globalizationId: $data['GlobalizationId'],
            productId: $data['ProductId'],
            title: $data['Title'],
            description: $data['Description'],
            USP: $data['USP'],
            metaName: $data['MetaName'],
            metaDescription: $data['MetaDescription'],
        );
    }
}
