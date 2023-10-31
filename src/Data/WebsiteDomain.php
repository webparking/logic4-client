<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class WebsiteDomain
{
    public function __construct(
        public int $id,
        public ?string $url,
        public ?string $title,
        public bool $isMainDomain,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            url: $data['Url'],
            title: $data['Title'],
            isMainDomain: $data['IsMainDomain'],
        );
    }
}
