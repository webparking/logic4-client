<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class ProductImageV2
{
    /** @param array<\Webparking\Logic4Client\Data\V30\GetProductImage> $productImages */
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
            productImages: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\GetProductImage::make($item), $data['ProductImages'] ?? []),
        );
    }
}
