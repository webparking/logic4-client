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
            userName: $data['UserName'] ?? null,
            statusDateTimeSince: isset($data['StatusDateTimeSince']) ? Carbon::parse($data['StatusDateTimeSince']) : null,
            statusId: $data['StatusId'] ?? 0,
            isAutoAwayStatus: $data['IsAutoAwayStatus'] ?? false,
            isOfflineStatus: $data['IsOfflineStatus'] ?? false,
            isOnlineStatus: $data['IsOnlineStatus'] ?? false,
            isOnThePhoneStatus: $data['IsOnThePhoneStatus'] ?? false,
            statusName: $data['StatusName'] ?? null,
            statusNotes: $data['StatusNotes'] ?? null,
            userId: $data['UserId'] ?? 0,
        );
    }
}
