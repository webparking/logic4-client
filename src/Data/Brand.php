<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class Brand
{
    public function __construct(
        public int $id,
        public ?string $name,
        public bool $visibleOnWebsite,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            visibleOnWebsite: $data['VisibleOnWebsite'] ?? false,
        );
    }
}
