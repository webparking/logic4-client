<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class PickbonSoftBlocked
{
    public function __construct(
        public ?int $userId,
        public ?\Carbon\Carbon $softBlockedAt,
        public ?string $username,
        public int $orderHeadPickbonId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            userId: $data['UserId'] ?? null,
            softBlockedAt: isset($data['SoftBlockedAt']) ? \Carbon\Carbon::parse($data['SoftBlockedAt']) : null,
            username: $data['Username'] ?? null,
            orderHeadPickbonId: $data['OrderHeadPickbonId'] ?? 0,
        );
    }
}
