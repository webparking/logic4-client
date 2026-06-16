<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V30;

class BundleGroup
{
    /** @param array<Child> $children */
    public function __construct(
        public int $id,
        public int $sortId,
        public ?string $description,
        public ?array $children,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            sortId: $data['SortId'] ?? 0,
            description: $data['Description'] ?? null,
            children: array_map(static fn (array $item) => Child::make($item), $data['Children'] ?? []),
        );
    }
}
