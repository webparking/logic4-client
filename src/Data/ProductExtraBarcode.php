<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            barcode: $data['Barcode'],
            qty: $data['Qty'],
        );
    }
}
