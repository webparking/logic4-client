<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductExtraBarcode
{
    public function __construct(
        public ?string $barcode,
        public int $qty,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            barcode: $data['Barcode'] ?? null,
            qty: $data['Qty'] ?? 0,
        );
    }
}
