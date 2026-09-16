<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class ProductMediaFileDto
{
    /** @param array<\Webparking\Logic4Client\Data\V30\ProductResource> $resources */
    public function __construct(
        public int $productId,
        public ?array $resources,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            resources: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\ProductResource::make($item), $data['Resources'] ?? []),
        );
    }
}
