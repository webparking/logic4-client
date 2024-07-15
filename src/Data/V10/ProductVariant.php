<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductVariant
{
    /** @param array<\Webparking\Logic4Client\Data\V10\Translation> $translations */
    public function __construct(
        public ?string $name,
        public int $id,
        public int $sort,
        public ?int $categoryId,
        public ?string $shortCode,
        public ?array $translations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            name: $data['Name'] ?? null,
            id: $data['Id'] ?? 0,
            sort: $data['Sort'] ?? 0,
            categoryId: $data['CategoryId'] ?? null,
            shortCode: $data['ShortCode'] ?? null,
            translations: array_map(static fn (array $item) => Translation::make($item), $data['Translations'] ?? []),
        );
    }
}
