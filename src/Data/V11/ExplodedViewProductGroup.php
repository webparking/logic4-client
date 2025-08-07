<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ExplodedViewProductGroup
{
    /** @param array<Translation> $productGroupNameTranslations */
    public function __construct(
        public int $productGroupId,
        public ?string $productGroupName,
        public ?array $productGroupNameTranslations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productGroupId: $data['ProductGroupId'] ?? 0,
            productGroupName: $data['ProductGroupName'] ?? null,
            productGroupNameTranslations: array_map(static fn (array $item) => Translation::make($item), $data['ProductGroupNameTranslations'] ?? []),
        );
    }
}
