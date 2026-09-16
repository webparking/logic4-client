<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class WebshopSearchWord
{
    public function __construct(
        public ?\Carbon\Carbon $dateTimeAdded,
        public ?int $websiteDomainId,
        public ?string $searchTerm,
        public ?string $visitorCode,
        public int $resultCount,
        public int $globalisationId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            dateTimeAdded: isset($data['DateTimeAdded']) ? \Carbon\Carbon::parse($data['DateTimeAdded']) : null,
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
            searchTerm: $data['SearchTerm'] ?? null,
            visitorCode: $data['VisitorCode'] ?? null,
            resultCount: $data['ResultCount'] ?? 0,
            globalisationId: $data['GlobalisationId'] ?? 0,
        );
    }
}
