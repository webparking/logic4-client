<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\Agenda;
use Webparking\Logic4Client\Responses\V30\Appointment;

class AppointmentsRequest extends Request
{
    /**
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, Agenda>
     *
     * @throws Logic4ApiException
     */
    public function getAgendas(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Agenda::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Appointments/GetAgendas', ['json' => $parameters]),
            ),
        );
    }

    /**
     * @param array{
     *     Subject?: string|null,
     *     AppointmentIds?: array<int>,
     *     HasITS?: bool|null,
     *     ITS_Id?: int|null,
     *     DebtorId?: int|null,
     *     CreditorId?: int|null,
     *     ContactId?: int|null,
     *     AgendaId?: int|null,
     *     TaskForUserId?: int|null,
     *     StartDateTimeFrom?: string|null,
     *     StartDateTimeUntil?: string|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, Appointment>
     *
     * @throws Logic4ApiException
     */
    public function getAppointments(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Appointment::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Appointments/GetAppointments', ['json' => $parameters]),
            ),
        );
    }
}
