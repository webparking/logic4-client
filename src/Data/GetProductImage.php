<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class GetProductImage
{
    public function __construct(
        public int $productId,
        public ?string $imageName,
        public int $imageId,
        public ?int $sortId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            imageName: $data['ImageName'] ?? null,
            imageId: $data['ImageId'] ?? 0,
            sortId: $data['SortId'] ?? null,
        );
    }
}
