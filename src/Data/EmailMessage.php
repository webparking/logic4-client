<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class EmailMessage
{
    /**
     * @param array<EmailAddress> $toEmailAddresses
     * @param array<EmailAddress> $CCEmailAddresses
     * @param array<EmailAddress> $BCCEmailAddresses
     */
    public function __construct(
        public int $id,
        public ?string $subject,
        public ?string $emailBody,
        public bool $isHTMLBody,
        public int $boxId,
        public ?Carbon $dateTimeSend,
        public bool $isInbound,
        public bool $isRead,
        public ?Carbon $isReplyedOn,
        public ?Carbon $isForwardedOn,
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
            id: $data['Id'],
            subject: $data['Subject'],
            emailBody: $data['EmailBody'],
            isHTMLBody: $data['IsHTMLBody'],
            boxId: $data['BoxId'],
            dateTimeSend: $data['DateTimeSend'] ? Carbon::parse($data['DateTimeSend']) : null,
            isInbound: $data['IsInbound'],
            isRead: $data['IsRead'],
            isReplyedOn: $data['IsReplyedOn'] ? Carbon::parse($data['IsReplyedOn']) : null,
            isForwardedOn: $data['IsForwardedOn'] ? Carbon::parse($data['IsForwardedOn']) : null,
            status: $data['Status'] ? EmailMessageStatus::make($data['Status']) : null,
            toEmailAddresses: array_map(static fn (array $item) => EmailAddress::make($item), $data['ToEmailAddresses'] ?? []),
            fromEmailAddress: $data['FromEmailAddress'] ? EmailAddress::make($data['FromEmailAddress']) : null,
            CCEmailAddresses: array_map(static fn (array $item) => EmailAddress::make($item), $data['CCEmailAddresses'] ?? []),
            BCCEmailAddresses: array_map(static fn (array $item) => EmailAddress::make($item), $data['BCCEmailAddresses'] ?? []),
            hasAttachment: $data['HasAttachment'],
            previousEmailId: $data['PreviousEmailId'],
            canDelete: $data['CanDelete'],
        );
    }
}
