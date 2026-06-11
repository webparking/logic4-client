<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V30;

class ProductStatus
{
    public function __construct(
        public int $statusId,
        public ?string $description,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            statusId: $data['StatusId'] ?? 0,
            description: $data['Description'] ?? null,
        );
    }
}
