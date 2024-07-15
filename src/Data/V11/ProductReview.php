<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductReview
{
    /** @param array<int> $websiteIds */
    public function __construct(
        public int $id,
        public ?int $productId,
        public ?string $username,
        public ?string $emailAddress,
        public ?\Carbon\Carbon $dateTimeCreated,
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
            id: $data['Id'] ?? 0,
            productId: $data['ProductId'] ?? null,
            username: $data['Username'] ?? null,
            emailAddress: $data['EmailAddress'] ?? null,
            dateTimeCreated: isset($data['DateTimeCreated']) ? \Carbon\Carbon::parse($data['DateTimeCreated']) : null,
            review: $data['Review'] ?? null,
            score: $data['Score'] ?? 0,
            websiteIds: $data['WebsiteIds'] ?? null,
            reaction: $data['Reaction'] ?? null,
        );
    }
}
