<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductVariantBalkChildrenGroupChildVariantOptions
{
    public function __construct(
        public int $variantBalkId,
        public int $variantOptionid,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            variantBalkId: $data['VariantBalkId'] ?? 0,
            variantOptionid: $data['VariantOptionid'] ?? 0,
        );
    }
}
