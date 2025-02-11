<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductBarcode
{
    /** @param array<BarcodeWithAmount> $barcodes */
    public function __construct(
        public ?array $barcodes,
        public int $productId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            barcodes: array_map(static fn (array $item) => BarcodeWithAmount::make($item), $data['Barcodes'] ?? []),
            productId: $data['ProductId'] ?? 0,
        );
    }
}
