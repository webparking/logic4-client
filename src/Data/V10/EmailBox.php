<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class EmailBox
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?int $parentId,
        public bool $userCanRead,
        public bool $userCanDelete,
        public int $sortId,
        public int $newMessages,
        public bool $hasEmails,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            parentId: $data['ParentId'] ?? null,
            userCanRead: $data['UserCanRead'] ?? false,
            userCanDelete: $data['UserCanDelete'] ?? false,
            sortId: $data['SortId'] ?? 0,
            newMessages: $data['NewMessages'] ?? 0,
            hasEmails: $data['HasEmails'] ?? false,
        );
    }
}
