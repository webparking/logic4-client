<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class RelatedProduct
{
    public function __construct(
        public int $relatedProductId,
        public int $relatedTypeId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            relatedProductId: $data['RelatedProductId'] ?? 0,
            relatedTypeId: $data['RelatedTypeId'] ?? 0,
        );
    }
}
