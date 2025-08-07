<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ExplodedViewHighlight
{
    /** @param array<ExplodedViewHighlightProduct> $products */
    public function __construct(
        public int $id,
        public ?string $name,
        public ?array $products,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            products: array_map(static fn (array $item) => ExplodedViewHighlightProduct::make($item), $data['Products'] ?? []),
        );
    }
}
