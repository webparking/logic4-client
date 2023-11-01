<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class Agenda
{
    public function __construct(
        public int $id,
        public ?string $name,
        public bool $visible,
        public int $sortId,
        public bool $syncWithGoogle,
        public ?string $googleUsername,
        public ?Carbon $googleLastSyncDateTime,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'],
            visible: $data['Visible'],
            sortId: $data['SortId'],
            syncWithGoogle: $data['SyncWithGoogle'],
            googleUsername: $data['GoogleUsername'],
            googleLastSyncDateTime: $data['GoogleLastSyncDateTime'] ? Carbon::parse($data['GoogleLastSyncDateTime']) : null,
        );
    }
}
