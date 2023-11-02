<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class BasicProductData
{
    public function __construct(
        public int $productId,
        public ?string $vendorCode,
        public ?string $productCode,
        public ?string $description1,
        public ?string $description2,
        public ?string $pictureName,
        public ?string $domain,
        public ?int $defaultPickStockLocationId,
        public ?string $statusName,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            vendorCode: $data['VendorCode'] ?? null,
            productCode: $data['ProductCode'] ?? null,
            description1: $data['Description1'] ?? null,
            description2: $data['Description2'] ?? null,
            pictureName: $data['PictureName'] ?? null,
            domain: $data['Domain'] ?? null,
            defaultPickStockLocationId: $data['DefaultPickStockLocationId'] ?? null,
            statusName: $data['StatusName'] ?? null,
        );
    }
}
