<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class VariantBalkCategoryTranslation
{
    public function __construct(
        public ?string $title,
        public ?string $information,
        public ?string $shortDescription,
        public int $globalisationId,
        public ?int $websiteDomainId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            title: $data['Title'] ?? null,
            information: $data['Information'] ?? null,
            shortDescription: $data['ShortDescription'] ?? null,
            globalisationId: $data['GlobalisationId'] ?? 0,
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
        );
    }
}
