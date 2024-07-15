<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class VariantBalkCategory
{
    /** @param array<\Webparking\Logic4Client\Data\V10\VariantBalkCategoryTranslation> $translations */
    public function __construct(
        public int $id,
        public ?string $value,
        public ?array $translations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            value: $data['Value'] ?? null,
            translations: array_map(static fn (array $item) => VariantBalkCategoryTranslation::make($item), $data['Translations'] ?? []),
        );
    }
}
