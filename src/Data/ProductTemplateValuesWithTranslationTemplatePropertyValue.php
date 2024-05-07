<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ProductTemplateValuesWithTranslationTemplatePropertyValue
{
    /** @param array<Translation> $translations */
    public function __construct(
        public ?string $value,
        public ?array $translations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: $data['Value'] ?? null,
            translations: array_map(static fn (array $item) => Translation::make($item), $data['Translations'] ?? []),
        );
    }
}
