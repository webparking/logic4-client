<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\HRMTimeRegistrationRowListLogic4Response;

class HRMRequest extends Request
{
    /**
     * Voeg urenregistraties toe in batch.
     *
     * @param array<array{
     *     UserId?: integer|null,
     *     PeriodId?: integer|null,
     *     Date?: string|null,
     *     ActivityId?: integer|null,
     *     ITSTaskId?: integer|null,
     *     CRMProjectId?: integer|null,
     *     ITSIssueId?: integer|null,
     *     Description?: string|null,
     *     Minutes?: integer|null,
     *     CreatePeriod?: boolean|null,
     *     PeriodeStatusId?: integer|null,
     *     RowIsAddedToPeriod?: boolean|null,
     *     Exception?: string|null,
     * }> $parameters
     *
     * @throws Logic4ApiException
     */
    public function addTimeRegistrations(
        array $parameters = [],
    ): HRMTimeRegistrationRowListLogic4Response {
        return HRMTimeRegistrationRowListLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/HRM/AddTimeRegistrations', ['json' => $parameters]),
            )
        );
    }
}
