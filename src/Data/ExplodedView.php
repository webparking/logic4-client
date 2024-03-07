<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ExplodedView
{
    /**
     * @param array<Translation>              $nameTranslations
     * @param array<ExplodedViewHighlight>    $highlights
     * @param array<ExplodedViewProductGroup> $productGroups
     */
    public function __construct(
        public int $id,
        public ?string $imageUrl,
        public ?int $sortId,
        public ?string $name,
        public ?array $nameTranslations,
        public ?array $highlights,
        public ?array $productGroups,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            imageUrl: $data['ImageUrl'] ?? null,
            sortId: $data['SortId'] ?? null,
            name: $data['Name'] ?? null,
            nameTranslations: array_map(static fn (array $item) => Translation::make($item), $data['NameTranslations'] ?? []),
            highlights: array_map(static fn (array $item) => ExplodedViewHighlight::make($item), $data['Highlights'] ?? []),
            productGroups: array_map(static fn (array $item) => ExplodedViewProductGroup::make($item), $data['Product_Groups'] ?? []),
        );
    }
}
