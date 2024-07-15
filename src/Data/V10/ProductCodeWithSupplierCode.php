<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductCodeWithSupplierCode
{
    public function __construct(
        public ?string $productCode,
        public ?string $supplierCode,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productCode: $data['ProductCode'] ?? null,
            supplierCode: $data['SupplierCode'] ?? null,
        );
    }
}
