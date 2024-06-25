<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\EmailAddressLogic4Response;
use Webparking\Logic4Client\Responses\EmailAttachmentLogic4Response;
use Webparking\Logic4Client\Responses\EmailAttachmentLogic4ResponseList;
use Webparking\Logic4Client\Responses\EmailBoxLogic4Response;
use Webparking\Logic4Client\Responses\EmailMessageLogic4Response;
use Webparking\Logic4Client\Responses\EmailMessageStatusLogic4Response;
use Webparking\Logic4Client\Responses\EmailUserLogic4Response;
use Webparking\Logic4Client\Responses\Int32Logic4Response;

class EmailRequest extends Request
{
    /**
     * @param array{
     *     Id?: integer|null,
     *     EmailMessageId?: integer|null,
     *     Name?: string|null,
     *     ContentId?: string|null,
     *     IsEmbeddedContent?: boolean|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addEmailAttachment(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/AddEmailAttachment', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array<array{
     *     Id?: integer|null,
     *     EmailMessageId?: integer|null,
     *     Name?: string|null,
     *     ContentId?: string|null,
     *     IsEmbeddedContent?: boolean|null,
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
     *     Id?: integer|null,
     *     Name?: string|null,
     *     ParentId?: integer|null,
     *     UserCanRead?: boolean|null,
     *     UserCanDelete?: boolean|null,
     *     SortId?: integer|null,
     *     NewMessages?: integer|null,
     *     HasEmails?: boolean|null,
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
     *     Id?: integer|null,
     *     Subject?: string|null,
     *     EmailBody?: string|null,
     *     IsHTMLBody?: boolean|null,
     *     BoxId?: integer|null,
     *     DateTimeSend?: string|null,
     *     IsInbound?: boolean|null,
     *     IsRead?: boolean|null,
     *     IsReplyedOn?: string|null,
     *     IsForwardedOn?: string|null,
     *     Status?: array{Id?: integer, Name?: string, Color?: integer}|null,
     *     ToEmailAddresses?: array<array{Name?: string, Email?: string}>|null,
     *     FromEmailAddress?: array{Name?: string, Email?: string}|null,
     *     CCEmailAddresses?: array<array{Name?: string, Email?: string}>|null,
     *     BCCEmailAddresses?: array<array{Name?: string, Email?: string}>|null,
     *     HasAttachment?: boolean|null,
     *     PreviousEmailId?: integer|null,
     *     CanDelete?: boolean|null,
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
     *     EmailIds?: array<integer>|null,
     *     EmailBoxId?: integer|null,
     *     EmailStatusId?: integer|null,
     *     IsRead?: boolean|null,
     *     Action?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function emailMessagesAction(array $parameters = []): BooleanLogic4Response
    {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/EmailMessagesAction', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     EmailMessageId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getEmailAttachments(
        array $parameters = [],
    ): EmailAttachmentLogic4Response {
        return EmailAttachmentLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/GetEmailAttachments', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ParentId?: integer|null,
     *     ShowOnlyTopLevelEmailboxes?: boolean|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getEmailBoxes(array $parameters = []): EmailBoxLogic4Response
    {
        return EmailBoxLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/GetEmailBoxes', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     EmailId?: integer|null,
     *     EmailboxId?: integer|null,
     *     IncludedSubEmailboxes?: boolean|null,
     *     StartDate?: string|null,
     *     EndDate?: string|null,
     *     OnlyWithAttachment?: boolean|null,
     *     StatusId?: integer|null,
     *     IsInbound?: boolean|null,
     *     SearchText1?: string|null,
     *     SearchText1Type?: string|null,
     *     SearchText2?: string|null,
     *     SearchText2Type?: string|null,
     *     SearchText2Switch?: string|null,
     *     SearchText3?: string|null,
     *     SearchText3Type?: string|null,
     *     SearchText3Switch?: string|null,
     *     GetEmailMessageBody?: boolean|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     OrderByNewestFirst?: boolean|null,
     *     LoadRights?: boolean|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getEmailMessages(
        array $parameters = [],
    ): EmailMessageLogic4Response {
        return EmailMessageLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/GetEmailMessages', ['json' => $parameters]),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getEmailMessageStatuses(): EmailMessageStatusLogic4Response
    {
        return EmailMessageStatusLogic4Response::make(
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
    public function getUsedEmailAddresses(): EmailAddressLogic4Response
    {
        return EmailAddressLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Email/GetUsedEmailAddresses'),
            )
        );
    }

    /**
     * Update een emailbox o.b.v. meegestuurde user Id.
     *
     * @param array{
     *     Id?: integer|null,
     *     Name?: string|null,
     *     ParentId?: integer|null,
     *     UserCanRead?: boolean|null,
     *     UserCanDelete?: boolean|null,
     *     SortId?: integer|null,
     *     NewMessages?: integer|null,
     *     HasEmails?: boolean|null,
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
     *     Id?: integer|null,
     *     Subject?: string|null,
     *     EmailBody?: string|null,
     *     IsHTMLBody?: boolean|null,
     *     BoxId?: integer|null,
     *     DateTimeSend?: string|null,
     *     IsInbound?: boolean|null,
     *     IsRead?: boolean|null,
     *     IsReplyedOn?: string|null,
     *     IsForwardedOn?: string|null,
     *     Status?: array{Id?: integer, Name?: string, Color?: integer}|null,
     *     ToEmailAddresses?: array<array{Name?: string, Email?: string}>|null,
     *     FromEmailAddress?: array{Name?: string, Email?: string}|null,
     *     CCEmailAddresses?: array<array{Name?: string, Email?: string}>|null,
     *     BCCEmailAddresses?: array<array{Name?: string, Email?: string}>|null,
     *     HasAttachment?: boolean|null,
     *     PreviousEmailId?: integer|null,
     *     CanDelete?: boolean|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateEmailMessage(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->put('/v1/Email/UpdateEmailMessage', ['json' => $parameters]),
            )
        );
    }
}
