<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductTemplate
{
    public function __construct(
        public int $templateId,
        public ?string $name,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            templateId: $data['TemplateId'] ?? 0,
            name: $data['Name'] ?? null,
        );
    }
}
