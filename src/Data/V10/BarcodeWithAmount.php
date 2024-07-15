<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class BarcodeWithAmount
{
    public function __construct(
        public int $qty,
        public ?string $barcode,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            qty: $data['Qty'] ?? 0,
            barcode: $data['Barcode'] ?? null,
        );
    }
}
