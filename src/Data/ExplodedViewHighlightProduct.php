<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ExplodedViewHighlightProduct
{
    /** @param array<Translation> $productNameTranslations */
    public function __construct(
        public int $productId,
        public ?string $productName1,
        public ?array $productNameTranslations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            productName1: $data['ProductName1'] ?? null,
            productNameTranslations: array_map(static fn (array $item) => Translation::make($item), $data['ProductNameTranslations'] ?? []),
        );
    }
}
