<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\Agenda;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;

class Appointment extends Request
{
    /**
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<Agenda>
     *
     * @throws Logic4ApiException
     */
    public function getAgendas(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1/Appointments/GetAgendas', $parameters),
            Agenda::class,
        );
    }

    /**
     * @param array{
     *     AppointmentIds?: array<integer>,
     *     HasITS?: boolean,
     *     ITS_Id?: integer,
     *     DebtorId?: integer,
     *     CreditorId?: integer,
     *     ContactId?: integer,
     *     AgendaId?: integer,
     *     TaskForUserId?: integer,
     *     StartDateTimeFrom?: string,
     *     StartDateTimeUntil?: string,
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<\Webparking\Logic4Client\Data\Appointment>
     *
     * @throws Logic4ApiException
     */
    public function getAppointments(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1/Appointments/GetAppointments', $parameters),
            \Webparking\Logic4Client\Data\Appointment::class,
        );
    }
}
