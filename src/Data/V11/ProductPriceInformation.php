<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductPriceInformation
{
    /** @param array<\Webparking\Logic4Client\Data\V11\ProductShiftPrice> $shiftPrices */
    public function __construct(
        public int $productId,
        public ?array $shiftPrices,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            shiftPrices: array_map(static fn (array $item) => ProductShiftPrice::make($item), $data['ShiftPrices'] ?? []),
        );
    }
}
