<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductImageV2
{
    /** @param array<GetProductImage> $productImages */
    public function __construct(
        public ?string $baseUrl,
        public ?array $productImages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            baseUrl: $data['BaseUrl'] ?? null,
            productImages: array_map(static fn (array $item) => GetProductImage::make($item), $data['ProductImages'] ?? []),
        );
    }
}
