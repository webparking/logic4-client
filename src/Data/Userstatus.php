<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class Userstatus
{
    public function __construct(
        public ?string $userName,
        public ?Carbon $statusDateTimeSince,
        public int $statusId,
        public bool $isAutoAwayStatus,
        public bool $isOfflineStatus,
        public bool $isOnlineStatus,
        public bool $isOnThePhoneStatus,
        public ?string $statusName,
        public ?string $statusNotes,
        public int $userId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            userName: $data['UserName'],
            statusDateTimeSince: $data['StatusDateTimeSince'] ? Carbon::parse($data['StatusDateTimeSince']) : null,
            statusId: $data['StatusId'],
            isAutoAwayStatus: $data['IsAutoAwayStatus'],
            isOfflineStatus: $data['IsOfflineStatus'],
            isOnlineStatus: $data['IsOnlineStatus'],
            isOnThePhoneStatus: $data['IsOnThePhoneStatus'],
            statusName: $data['StatusName'],
            statusNotes: $data['StatusNotes'],
            userId: $data['UserId'],
        );
    }
}
