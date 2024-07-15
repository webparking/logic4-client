<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class EmailMessage
{
    /**
     * @param array<\Webparking\Logic4Client\Data\V10\EmailAddress> $toEmailAddresses
     * @param array<\Webparking\Logic4Client\Data\V10\EmailAddress> $CCEmailAddresses
     * @param array<\Webparking\Logic4Client\Data\V10\EmailAddress> $BCCEmailAddresses
     */
    public function __construct(
        public int $id,
        public ?string $subject,
        public ?string $emailBody,
        public bool $isHTMLBody,
        public int $boxId,
        public ?\Carbon\Carbon $dateTimeSend,
        public bool $isInbound,
        public bool $isRead,
        public ?\Carbon\Carbon $isReplyedOn,
        public ?\Carbon\Carbon $isForwardedOn,
        public ?EmailMessageStatus $status,
        public array $toEmailAddresses,
        public ?EmailAddress $fromEmailAddress,
        public ?array $CCEmailAddresses,
        public ?array $BCCEmailAddresses,
        public bool $hasAttachment,
        public ?int $previousEmailId,
        public ?bool $canDelete,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            subject: $data['Subject'] ?? null,
            emailBody: $data['EmailBody'] ?? null,
            isHTMLBody: $data['IsHTMLBody'] ?? false,
            boxId: $data['BoxId'] ?? 0,
            dateTimeSend: isset($data['DateTimeSend']) ? \Carbon\Carbon::parse($data['DateTimeSend']) : null,
            isInbound: $data['IsInbound'] ?? false,
            isRead: $data['IsRead'] ?? false,
            isReplyedOn: isset($data['IsReplyedOn']) ? \Carbon\Carbon::parse($data['IsReplyedOn']) : null,
            isForwardedOn: isset($data['IsForwardedOn']) ? \Carbon\Carbon::parse($data['IsForwardedOn']) : null,
            status: isset($data['Status']) ? EmailMessageStatus::make($data['Status']) : null,
            toEmailAddresses: array_map(static fn (array $item) => EmailAddress::make($item), $data['ToEmailAddresses'] ?? []),
            fromEmailAddress: isset($data['FromEmailAddress']) ? EmailAddress::make($data['FromEmailAddress']) : null,
            CCEmailAddresses: array_map(static fn (array $item) => EmailAddress::make($item), $data['CCEmailAddresses'] ?? []),
            BCCEmailAddresses: array_map(static fn (array $item) => EmailAddress::make($item), $data['BCCEmailAddresses'] ?? []),
            hasAttachment: $data['HasAttachment'] ?? false,
            previousEmailId: $data['PreviousEmailId'] ?? null,
            canDelete: $data['CanDelete'] ?? null,
        );
    }
}
