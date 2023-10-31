<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ProductReview
{
    /** @param array<integer> $websiteIds */
    public function __construct(
        public int $id,
        public ?int $productId,
        public ?string $username,
        public ?string $emailAddress,
        public ?Carbon $dateTimeCreated,
        public ?string $review,
        public int $score,
        public ?array $websiteIds,
        public ?string $reaction,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            productId: $data['ProductId'],
            username: $data['Username'],
            emailAddress: $data['EmailAddress'],
            dateTimeCreated: $data['DateTimeCreated'] ? Carbon::parse($data['DateTimeCreated']) : null,
            review: $data['Review'],
            score: $data['Score'],
            websiteIds: $data['WebsiteIds'],
            reaction: $data['Reaction'],
        );
    }
}
