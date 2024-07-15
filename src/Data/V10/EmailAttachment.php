<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class EmailAttachment
{
    public function __construct(
        public int $id,
        public int $emailMessageId,
        public ?string $name,
        public ?string $contentId,
        public bool $isEmbeddedContent,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            emailMessageId: $data['EmailMessageId'] ?? 0,
            name: $data['Name'] ?? null,
            contentId: $data['ContentId'] ?? null,
            isEmbeddedContent: $data['IsEmbeddedContent'] ?? false,
        );
    }
}
