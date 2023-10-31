<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            id: $data['Id'],
            emailMessageId: $data['EmailMessageId'],
            name: $data['Name'],
            contentId: $data['ContentId'],
            isEmbeddedContent: $data['IsEmbeddedContent'],
        );
    }
}
