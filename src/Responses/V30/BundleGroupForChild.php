<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class BundleGroupForChild
{
    public function __construct(
        public int $bundleGroupId,
        public int $parentProductId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            bundleGroupId: $data['BundleGroupId'] ?? 0,
            parentProductId: $data['ParentProductId'] ?? 0,
        );
    }
}
