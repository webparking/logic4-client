<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class DebtorWebsiteDomainsList
{
    /** @param array<\Webparking\Logic4Client\Data\V30\DebtorWebsiteDomains> $debtorWebsiteDomains */
    public function __construct(
        public ?array $debtorWebsiteDomains,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            debtorWebsiteDomains: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\DebtorWebsiteDomains::make($item), $data['DebtorWebsiteDomains'] ?? []),
        );
    }
}
