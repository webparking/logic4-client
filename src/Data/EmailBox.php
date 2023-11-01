<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

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
            id: $data['Id'],
            name: $data['Name'],
            parentId: $data['ParentId'],
            userCanRead: $data['UserCanRead'],
            userCanDelete: $data['UserCanDelete'],
            sortId: $data['SortId'],
            newMessages: $data['NewMessages'],
            hasEmails: $data['HasEmails'],
        );
    }
}
