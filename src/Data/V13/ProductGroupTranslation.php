<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V13;

class ProductGroupTranslation
{
    public function __construct(
        public int $productGroupId,
        public int $globalisationId,
        public ?string $h1Tag,
        public ?string $keywords,
        public ?string $name,
        public ?string $productGroupInfo,
        public ?string $value,
        public ?string $metaDescription,
        public ?int $websiteDomainId,
        public ?string $shortName,
        public ?string $globalisationCode,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productGroupId: $data['Product_GroupId'] ?? 0,
            globalisationId: $data['GlobalisationId'] ?? 0,
            h1Tag: $data['H1Tag'] ?? null,
            keywords: $data['Keywords'] ?? null,
            name: $data['Name'] ?? null,
            productGroupInfo: $data['ProductGroupInfo'] ?? null,
            value: $data['Value'] ?? null,
            metaDescription: $data['MetaDescription'] ?? null,
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
            shortName: $data['ShortName'] ?? null,
            globalisationCode: $data['GlobalisationCode'] ?? null,
        );
    }
}
