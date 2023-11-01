<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class WebshopSearchWord
{
    public function __construct(
        public ?Carbon $dateTimeAdded,
        public ?int $websiteDomainId,
        public ?string $searchTerm,
        public ?string $visitorCode,
        public int $resultCount,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            dateTimeAdded: $data['DateTimeAdded'] ? Carbon::parse($data['DateTimeAdded']) : null,
            websiteDomainId: $data['WebsiteDomainId'],
            searchTerm: $data['SearchTerm'],
            visitorCode: $data['VisitorCode'],
            resultCount: $data['ResultCount'],
        );
    }
}
