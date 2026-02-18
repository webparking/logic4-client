<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\Agenda;
use Webparking\Logic4Client\Data\V10\Appointment;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class AppointmentRequest extends Request
{
    /**
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
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
