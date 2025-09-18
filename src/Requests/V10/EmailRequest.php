<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\EmailMessage;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\EmailAddressLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\EmailAttachmentLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\EmailBoxLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\EmailMessageStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\EmailUserLogic4Response;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;

class EmailRequest extends Request
{
    /**
     * @param array{
     *     Id?: int|null,
     *     EmailMessageId?: int|null,
     *     Name?: string|null,
     *     ContentId?: string|null,
     *     IsEmbeddedContent?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addEmailAttachment(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/AddEmailAttachment', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array<array{
     *     Id?: int|null,
     *     EmailMessageId?: int|null,
     *     Name?: string|null,
     *     ContentId?: string|null,
     *     IsEmbeddedContent?: bool|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function addEmailAttachments(
        array $parameters = [],
    ): EmailAttachmentLogic4ResponseList {
        return EmailAttachmentLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/AddEmailAttachments', ['json' => $parameters]),
            )
        );
    }

    /**
     * Maak een nieuwe emailbox aan, bij een onderliggende emailbox worden de rechten overgenomen van de bovenliggende emailbox.
     * Als het om een submap van de inbox gaat worden deze rechten overgenomen.
     *
     * @param array{
     *     Id?: int|null,
     *     Name?: string|null,
     *     ParentId?: int|null,
     *     UserCanRead?: bool|null,
     *     UserCanDelete?: bool|null,
     *     SortId?: int|null,
     *     NewMessages?: int|null,
     *     HasEmails?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addEmailBox(array $parameters = []): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/AddEmailBox', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     Id?: int|null,
     *     Subject?: string|null,
     *     EmailBody?: string|null,
     *     IsHTMLBody?: bool|null,
     *     BoxId?: int|null,
     *     DateTimeSend?: string|null,
     *     IsInbound?: bool|null,
     *     IsRead?: bool|null,
     *     IsReplyedOn?: string|null,
     *     IsForwardedOn?: string|null,
     *     Status?: array{Id?: int, Name?: string|null, Color?: int}|null,
     *     ToEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>|null,
     *     FromEmailAddress?: array{Name?: string|null, Email?: string|null}|null,
     *     CCEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>|null,
     *     BCCEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>|null,
     *     HasAttachment?: bool|null,
     *     PreviousEmailId?: int|null,
     *     CanDelete?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addEmailMessage(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/AddEmailMessage', ['json' => $parameters]),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function deleteEmailAttachment(int $value): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/DeleteEmailAttachment', ['json' => $value]),
            )
        );
    }

    /**
     * Verwijder een emailbox, let op dit kan alleen als er geen emails of onderliggende emailboxen aan gekoppeld zijn.
     *
     * @throws Logic4ApiException
     */
    public function deleteEmailBox(int $value): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/DeleteEmailBox', ['json' => $value]),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function deleteEmailMessage(int $value): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/DeleteEmailMessage', ['json' => $value]),
            )
        );
    }

    /**
     * @param array{
     *     EmailIds?: array<int>|null,
     *     EmailBoxId?: int|null,
     *     EmailStatusId?: int|null,
     *     IsRead?: bool|null,
     *     Action?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function emailMessagesAction(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/EmailMessagesAction', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     EmailMessageId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getEmailAttachments(
        array $parameters = [],
    ): EmailAttachmentLogic4ResponseList {
        return EmailAttachmentLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/GetEmailAttachments', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ParentId?: int|null,
     *     ShowOnlyTopLevelEmailboxes?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getEmailBoxes(
        array $parameters = [],
    ): EmailBoxLogic4ResponseList {
        return EmailBoxLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/GetEmailBoxes', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     EmailId?: int|null,
     *     EmailboxId?: int|null,
     *     IncludedSubEmailboxes?: bool|null,
     *     StartDate?: string|null,
     *     EndDate?: string|null,
     *     OnlyWithAttachment?: bool|null,
     *     StatusId?: int|null,
     *     IsInbound?: bool|null,
     *     SearchText1?: string|null,
     *     SearchText1Type?: string|null,
     *     SearchText2?: string|null,
     *     SearchText2Type?: string|null,
     *     SearchText2Switch?: string|null,
     *     SearchText3?: string|null,
     *     SearchText3Type?: string|null,
     *     SearchText3Switch?: string|null,
     *     GetEmailMessageBody?: bool|null,
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     *     OrderByNewestFirst?: bool|null,
     *     LoadRights?: bool|null,
     * } $parameters
     *
     * @return \Generator<array-key, EmailMessage>
     *
     * @throws Logic4ApiException
     */
    public function getEmailMessages(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Email/GetEmailMessages', $parameters);

        foreach ($iterator as $record) {
            yield EmailMessage::make($record);
        }
    }

    /**
     * @throws Logic4ApiException
     */
    public function getEmailMessageStatuses(
    ): EmailMessageStatusLogic4ResponseList {
        return EmailMessageStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Email/GetEmailMessageStatuses'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getEmailUser(): EmailUserLogic4Response
    {
        return EmailUserLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Email/GetEmailUser'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getUsedEmailAddresses(): EmailAddressLogic4ResponseList
    {
        return EmailAddressLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Email/GetUsedEmailAddresses'),
            )
        );
    }

    /**
     * Update een emailbox o.b.v. meegestuurde user Id.
     *
     * @param array{
     *     Id?: int|null,
     *     Name?: string|null,
     *     ParentId?: int|null,
     *     UserCanRead?: bool|null,
     *     UserCanDelete?: bool|null,
     *     SortId?: int|null,
     *     NewMessages?: int|null,
     *     HasEmails?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateEmailBox(array $parameters = []): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/UpdateEmailBox', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     Id?: int|null,
     *     Subject?: string|null,
     *     EmailBody?: string|null,
     *     IsHTMLBody?: bool|null,
     *     BoxId?: int|null,
     *     DateTimeSend?: string|null,
     *     IsInbound?: bool|null,
     *     IsRead?: bool|null,
     *     IsReplyedOn?: string|null,
     *     IsForwardedOn?: string|null,
     *     Status?: array{Id?: int, Name?: string|null, Color?: int}|null,
     *     ToEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>|null,
     *     FromEmailAddress?: array{Name?: string|null, Email?: string|null}|null,
     *     CCEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>|null,
     *     BCCEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>|null,
     *     HasAttachment?: bool|null,
     *     PreviousEmailId?: int|null,
     *     CanDelete?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateEmailMessage(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->put('/v1/Email/UpdateEmailMessage', ['json' => $parameters]),
            )
        );
    }
}
