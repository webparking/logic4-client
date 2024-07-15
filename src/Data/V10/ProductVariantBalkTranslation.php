<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductVariantBalkTranslation
{
    public function __construct(
        public ?string $value,
        public int $globalisationId,
        public ?int $websiteDomainId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: $data['Value'] ?? null,
            globalisationId: $data['GlobalisationId'] ?? 0,
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
        );
    }
}
