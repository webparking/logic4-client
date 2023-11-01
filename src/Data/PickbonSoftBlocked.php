<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class PickbonSoftBlocked
{
    public function __construct(
        public ?int $userId,
        public ?Carbon $softBlockedAt,
        public ?string $username,
        public int $orderHeadPickbonId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            userId: $data['UserId'],
            softBlockedAt: $data['SoftBlockedAt'] ? Carbon::parse($data['SoftBlockedAt']) : null,
            username: $data['Username'],
            orderHeadPickbonId: $data['OrderHeadPickbonId'],
        );
    }
}
