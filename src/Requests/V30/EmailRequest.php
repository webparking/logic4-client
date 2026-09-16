<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\EmailAddress;
use Webparking\Logic4Client\Responses\V30\EmailAttachment;
use Webparking\Logic4Client\Responses\V30\EmailBox;
use Webparking\Logic4Client\Responses\V30\EmailMessage;
use Webparking\Logic4Client\Responses\V30\EmailMessageStatus;
use Webparking\Logic4Client\Responses\V30\EmailUser;

class EmailRequest extends Request
{
    /**
     * Voeg nieuwe bijlagen toe aan emails met een lege inhoud.
     *
     * @param array<array{
     *     Id?: int,
     *     EmailMessageId?: int,
     *     Name?: string|null,
     *     ContentId?: string|null,
     *     IsEmbeddedContent?: bool,
     * }> $parameters
     *
     * @return array<array-key, EmailAttachment>
     *
     * @throws Logic4ApiException
     */
    public function addEmailAttachments(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => EmailAttachment::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Email/AddEmailAttachments', ['json' => $parameters]),
            ),
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
    public function addEmailBox(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Email/AddEmailBox', ['json' => $parameters]),
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
    public function addEmailMessage(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Email/AddEmailMessage', ['json' => $parameters]),
        );
    }

    /**
     * Verwijder een emailbijlage o.b.v. email-attachment Id.
     *
     * @throws Logic4ApiException
     */
    public function deleteEmailAttachment(int $id): void
    {
        $this->getClient()->delete('/v3/Email/DeleteEmailAttachment', ['query' => ['id' => $id]]);
    }

    /**
     * Verwijder een emailbox, let op dit kan alleen als er geen emails of onderliggende emailboxen aan gekoppeld zijn.
     *
     * @throws Logic4ApiException
     */
    public function deleteEmailBox(int $id): void
    {
        $this->getClient()->delete('/v3/Email/DeleteEmailBox', ['query' => ['id' => $id]]);
    }

    /**
     * Verwijder een email.
     *
     * @throws Logic4ApiException
     */
    public function deleteEmailMessage(int $id): void
    {
        $this->getClient()->delete('/v3/Email/DeleteEmailMessage', ['query' => ['id' => $id]]);
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
    public function emailMessagesAction(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Email/EmailMessagesAction', ['json' => $parameters]);
    }

    /**
     * Verkrijg emailbijlagen van een emailmessage.
     *
     * @param array{
     *     EmailMessageId?: int,
     * } $parameters
     *
     * @return array<array-key, EmailAttachment>
     *
     * @throws Logic4ApiException
     */
    public function getEmailAttachments(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => EmailAttachment::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Email/GetEmailAttachments', ['json' => $parameters]),
            ),
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
     * @return array<array-key, EmailBox>
     *
     * @throws Logic4ApiException
     */
    public function getEmailBoxes(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => EmailBox::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Email/GetEmailBoxes', ['json' => $parameters]),
            ),
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
     * @return array<array-key, EmailMessage>
     *
     * @throws Logic4ApiException
     */
    public function getEmailMessages(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => EmailMessage::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Email/GetEmailMessages', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg emailberichten statussen.
     *
     * @return array<array-key, EmailMessageStatus>
     *
     * @throws Logic4ApiException
     */
    public function getEmailMessageStatuses(): array
    {
        return array_map(
            static fn (array $data) => EmailMessageStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Email/GetEmailMessageStatuses'),
            ),
        );
    }

    /**
     * Verkrijg een emailuser o.b.v. meegestuurde user Id.
     *
     * @throws Logic4ApiException
     */
    public function getEmailUser(): EmailUser
    {
        return EmailUser::make(
            $this->buildResponse(
                $this->getClient()->get('/v3/Email/GetEmailUser'),
            )
        );
    }

    /**
     * Verkrijg email-snelkeuzes.
     *
     * @return array<array-key, EmailAddress>
     *
     * @throws Logic4ApiException
     */
    public function getUsedEmailAddresses(): array
    {
        return array_map(
            static fn (array $data) => EmailAddress::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Email/GetUsedEmailAddresses'),
            ),
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
    public function updateEmailMessage(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->put('/v3/Email/UpdateEmailMessage', ['json' => $parameters]),
        );
    }
}
