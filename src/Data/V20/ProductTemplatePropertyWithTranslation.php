<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductTemplatePropertyWithTranslation
{
    /** @param array<\Webparking\Logic4Client\Data\V20\Translation> $translations */
    public function __construct(
        public int $templatePropertyId,
        public ?string $templatePropertyName,
        public ?array $translations,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            templatePropertyId: $data['TemplatePropertyId'] ?? 0,
            templatePropertyName: $data['TemplatePropertyName'] ?? null,
            translations: array_map(static fn (array $item) => Translation::make($item), $data['Translations'] ?? []),
        );
    }
}
