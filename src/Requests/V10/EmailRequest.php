<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\EmailMessage;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfEmailAddress;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfEmailAttachment;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfEmailBox;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfEmailMessageStatus;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfboolean;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfEmailUser;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfint;

class EmailRequest extends Request
{
    /**
     * Voeg een nieuwe bijlage toe aan een email zonder de byte array.
     *
     * @param array{
     *     Id?: int,
     *     EmailMessageId?: int,
     *     Name?: string|null,
     *     ContentId?: string|null,
     *     IsEmbeddedContent?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addEmailAttachment(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/AddEmailAttachment', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een nieuwe bijlages toe aan een email zonder de byte array.
     *
     * @param array<array{
     *     Id?: int,
     *     EmailMessageId?: int,
     *     Name?: string|null,
     *     ContentId?: string|null,
     *     IsEmbeddedContent?: bool,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function addEmailAttachments(
        array $parameters = [],
    ): Logic4ResponseListOfEmailAttachment {
        return Logic4ResponseListOfEmailAttachment::make(
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
     *     Id?: int,
     *     Name?: string|null,
     *     ParentId?: int|null,
     *     UserCanRead?: bool,
     *     UserCanDelete?: bool,
     *     SortId?: int,
     *     NewMessages?: int,
     *     HasEmails?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addEmailBox(array $parameters = []): Logic4ResponseOfboolean
    {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/AddEmailBox', ['json' => $parameters]),
            )
        );
    }

    /**
     * Voeg een nieuwe email toe in de conceptenmap van de gebruiker.
     *
     * @param array{
     *     Id?: int,
     *     Subject?: string|null,
     *     EmailBody?: string|null,
     *     IsHTMLBody?: bool,
     *     BoxId?: int,
     *     DateTimeSend?: string,
     *     IsInbound?: bool,
     *     IsRead?: bool,
     *     IsReplyedOn?: string|null,
     *     IsForwardedOn?: string|null,
     *     Status?: array{Id?: int, Name?: string|null, Color?: int},
     *     ToEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>,
     *     FromEmailAddress?: array{Name?: string|null, Email?: string|null},
     *     CCEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>,
     *     BCCEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>,
     *     HasAttachment?: bool,
     *     PreviousEmailId?: int|null,
     *     CanDelete?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addEmailMessage(array $parameters = []): Logic4ResponseOfint
    {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/AddEmailMessage', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een emailbijlage o.b.v. email-attachment Id.
     *
     * @throws Logic4ApiException
     */
    public function deleteEmailAttachment(int $value): Logic4ResponseOfboolean
    {
        return Logic4ResponseOfboolean::make(
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
    public function deleteEmailBox(int $value): Logic4ResponseOfboolean
    {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/DeleteEmailBox', ['json' => $value]),
            )
        );
    }

    /**
     * Verwijder een email.
     *
     * @throws Logic4ApiException
     */
    public function deleteEmailMessage(int $value): Logic4ResponseOfboolean
    {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/DeleteEmailMessage', ['json' => $value]),
            )
        );
    }

    /**
     * Update minimale gegevens van een email.
     *
     * @param array{
     *     EmailIds?: array<int>,
     *     EmailBoxId?: int|null,
     *     EmailStatusId?: int|null,
     *     IsRead?: bool|null,
     *     Action?: mixed,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function emailMessagesAction(
        array $parameters = [],
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/EmailMessagesAction', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg emailbijlagen van een emailmessage.
     *
     * @param array{
     *     EmailMessageId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getEmailAttachments(
        array $parameters = [],
    ): Logic4ResponseListOfEmailAttachment {
        return Logic4ResponseListOfEmailAttachment::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/GetEmailAttachments', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg emailboxen o.b.v. meegestuurde user Id.
     *
     * @param array{
     *     ParentId?: int|null,
     *     ShowOnlyTopLevelEmailboxes?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getEmailBoxes(
        array $parameters = [],
    ): Logic4ResponseListOfEmailBox {
        return Logic4ResponseListOfEmailBox::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/GetEmailBoxes', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg emailmessages o.b.v. het meegestuurde filter.
     *
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
     *     OrderByNewestFirst?: bool,
     *     LoadRights?: bool,
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
     * Verkrijg emailberichten statussen.
     *
     * @throws Logic4ApiException
     */
    public function getEmailMessageStatuses(
    ): Logic4ResponseListOfEmailMessageStatus {
        return Logic4ResponseListOfEmailMessageStatus::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Email/GetEmailMessageStatuses'),
            )
        );
    }

    /**
     * Verkrijg een emailuser o.b.v. meegestuurde user Id.
     *
     * @throws Logic4ApiException
     */
    public function getEmailUser(): Logic4ResponseOfEmailUser
    {
        return Logic4ResponseOfEmailUser::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Email/GetEmailUser'),
            )
        );
    }

    /**
     * Verkrijg email-snelkeuzes.
     *
     * @throws Logic4ApiException
     */
    public function getUsedEmailAddresses(): Logic4ResponseListOfEmailAddress
    {
        return Logic4ResponseListOfEmailAddress::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Email/GetUsedEmailAddresses'),
            )
        );
    }

    /**
     * Update een emailbox o.b.v. meegestuurde user Id.
     *
     * @param array{
     *     Id?: int,
     *     Name?: string|null,
     *     ParentId?: int|null,
     *     UserCanRead?: bool,
     *     UserCanDelete?: bool,
     *     SortId?: int,
     *     NewMessages?: int,
     *     HasEmails?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateEmailBox(
        array $parameters = [],
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Email/UpdateEmailBox', ['json' => $parameters]),
            )
        );
    }

    /**
     * Update een bestaande email.
     *
     * @param array{
     *     Id?: int,
     *     Subject?: string|null,
     *     EmailBody?: string|null,
     *     IsHTMLBody?: bool,
     *     BoxId?: int,
     *     DateTimeSend?: string,
     *     IsInbound?: bool,
     *     IsRead?: bool,
     *     IsReplyedOn?: string|null,
     *     IsForwardedOn?: string|null,
     *     Status?: array{Id?: int, Name?: string|null, Color?: int},
     *     ToEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>,
     *     FromEmailAddress?: array{Name?: string|null, Email?: string|null},
     *     CCEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>,
     *     BCCEmailAddresses?: array<array{Name?: string|null, Email?: string|null}>,
     *     HasAttachment?: bool,
     *     PreviousEmailId?: int|null,
     *     CanDelete?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateEmailMessage(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->put('/v1/Email/UpdateEmailMessage', ['json' => $parameters]),
            )
        );
    }
}
