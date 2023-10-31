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
            productId: $data['ProductId'],
            imageName: $data['ImageName'],
            imageId: $data['ImageId'],
            sortId: $data['SortId'],
        );
    }
}