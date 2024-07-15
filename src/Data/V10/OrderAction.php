<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class OrderAction
{
    public function __construct(
        public int $orderId,
        public ?\Carbon\Carbon $dateTimeCreated,
        public ?string $description,
        public int $userId,
        public ?int $relatedId,
        public ?string $typeDescription,
        public int $typeId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            orderId: $data['OrderId'] ?? 0,
            dateTimeCreated: isset($data['DateTimeCreated']) ? \Carbon\Carbon::parse($data['DateTimeCreated']) : null,
            description: $data['Description'] ?? null,
            userId: $data['UserId'] ?? 0,
            relatedId: $data['RelatedId'] ?? null,
            typeDescription: $data['TypeDescription'] ?? null,
            typeId: $data['TypeId'] ?? 0,
        );
    }
}
