<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\CRMActivity;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class CRMRequest extends Request
{
    /**
     * Verkrijg CRM activiteiten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     * De hoeveelheid activiteiten wordt gelimiteerd aan de hand van opgegeven SkipRecords en TakeRecords.
     * TakeRecords wordt gelimiteerd op 10.000.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     CrmProjectId?: integer|null,
     *     CreatedDateFrom?: string|null,
     *     CreatedDateTo?: string|null,
     *     StatusIds?: array<integer>|null,
     *     CreatedByUserIds?: array<integer>|null,
     *     CarriedOutByUserId?: integer|null,
     *     StartDateFrom?: string|null,
     *     StartDateTo?: string|null,
     *     Name?: string|null,
     *     TypeId?: integer|null,
     *     CrmProjectStatusId?: integer|null,
     *     CrmProjectTypeId?: integer|null,
     *     CrmProjectName?: string|null,
     *     ShowOnlyOpenActivities?: boolean|null,
     *     UserIdForRights?: integer|null,
     *     CarriedOutByUserIds?: array<integer>|null,
     * } $parameters
     *
     * @return \Generator<array-key, CRMActivity>
     *
     * @throws Logic4ApiException
     */
    public function getCRMActivities(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/CRM/GetCRMActivities', $parameters);

        foreach ($iterator as $record) {
            yield CRMActivity::make($record);
        }
    }
}
