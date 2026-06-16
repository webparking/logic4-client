<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V30;

class RelatedProductV3
{
    public function __construct(
        public int $relatedProductId,
        public int $relatedTypeId,
        public ?string $freeValue1,
        public ?string $freeValue2,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            relatedProductId: $data['RelatedProductId'] ?? 0,
            relatedTypeId: $data['RelatedTypeId'] ?? 0,
            freeValue1: $data['FreeValue1'] ?? null,
            freeValue2: $data['FreeValue2'] ?? null,
        );
    }
}
