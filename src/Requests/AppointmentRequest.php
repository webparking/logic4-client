<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\Agenda;
use Webparking\Logic4Client\Data\Appointment;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class AppointmentRequest extends Request
{
    /**
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, Agenda>
     *
     * @throws Logic4ApiException
     */
    public function getAgendas(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Appointments/GetAgendas', $parameters);

        foreach ($iterator as $record) {
            yield Agenda::make($record);
        }
    }

    /**
     * @param array{
     *     AppointmentIds?: array<integer>|null,
     *     HasITS?: boolean|null,
     *     ITS_Id?: integer|null,
     *     DebtorId?: integer|null,
     *     CreditorId?: integer|null,
     *     ContactId?: integer|null,
     *     AgendaId?: integer|null,
     *     TaskForUserId?: integer|null,
     *     StartDateTimeFrom?: string|null,
     *     StartDateTimeUntil?: string|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, Appointment>
     *
     * @throws Logic4ApiException
     */
    public function getAppointments(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Appointments/GetAppointments', $parameters);

        foreach ($iterator as $record) {
            yield Appointment::make($record);
        }
    }
}
