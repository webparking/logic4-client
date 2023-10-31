<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class OrderAction
{
    public function __construct(
        public int $orderId,
        public ?Carbon $dateTimeCreated,
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
            orderId: $data['OrderId'],
            dateTimeCreated: $data['DateTimeCreated'] ? Carbon::parse($data['DateTimeCreated']) : null,
            description: $data['Description'],
            userId: $data['UserId'],
            relatedId: $data['RelatedId'],
            typeDescription: $data['TypeDescription'],
            typeId: $data['TypeId'],
        );
    }
}
