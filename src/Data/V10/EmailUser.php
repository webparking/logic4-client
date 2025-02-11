<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class EmailUser
{
    /** @param array<EmailUserEmailAddress> $emailAddresses */
    public function __construct(
        public ?array $emailAddresses,
        public ?int $startBoxId,
        public ?int $deleteBoxId,
        public ?int $sendBoxId,
        public ?int $outBoxId,
        public ?int $conceptBoxId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            emailAddresses: array_map(static fn (array $item) => EmailUserEmailAddress::make($item), $data['EmailAddresses'] ?? []),
            startBoxId: $data['StartBoxId'] ?? null,
            deleteBoxId: $data['DeleteBoxId'] ?? null,
            sendBoxId: $data['SendBoxId'] ?? null,
            outBoxId: $data['OutBoxId'] ?? null,
            conceptBoxId: $data['ConceptBoxId'] ?? null,
        );
    }
}
