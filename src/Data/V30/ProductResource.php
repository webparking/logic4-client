<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V30;

class ProductResource
{
    public function __construct(
        public ?string $fileName,
        public ?string $type,
        public ?string $description,
        public ?int $sorting,
        public ?string $url,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            fileName: $data['FileName'] ?? null,
            type: $data['Type'] ?? null,
            description: $data['Description'] ?? null,
            sorting: $data['Sorting'] ?? null,
            url: $data['Url'] ?? null,
        );
    }
}
