<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class Agenda
{
    public function __construct(
        public int $id,
        public ?string $name,
        public bool $visible,
        public int $sortId,
        public bool $syncWithGoogle,
        public ?string $googleUsername,
        public ?\Carbon\Carbon $googleLastSyncDateTime,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            visible: $data['Visible'] ?? false,
            sortId: $data['SortId'] ?? 0,
            syncWithGoogle: $data['SyncWithGoogle'] ?? false,
            googleUsername: $data['GoogleUsername'] ?? null,
            googleLastSyncDateTime: isset($data['GoogleLastSyncDateTime']) ? \Carbon\Carbon::parse($data['GoogleLastSyncDateTime']) : null,
        );
    }
}
