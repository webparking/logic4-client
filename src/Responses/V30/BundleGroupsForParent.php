<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class BundleGroupsForParent
{
    /** @param array<\Webparking\Logic4Client\Data\V30\BundleGroup> $bundleGroups */
    public function __construct(
        public int $parentProductId,
        public ?array $bundleGroups,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            parentProductId: $data['ParentProductId'] ?? 0,
            bundleGroups: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V30\BundleGroup::make($item), $data['BundleGroups'] ?? []),
        );
    }
}
