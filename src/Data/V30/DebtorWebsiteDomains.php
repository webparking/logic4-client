<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V30;

class DebtorWebsiteDomains
{
    /** @param array<int> $websiteDomainIds */
    public function __construct(
        public int $debtorId,
        public ?array $websiteDomainIds,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            debtorId: $data['DebtorId'] ?? 0,
            websiteDomainIds: $data['WebsiteDomainIds'] ?? null,
        );
    }
}
