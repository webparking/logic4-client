<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\HRMTimeRegistrationRowListLogic4Response;

class HRMRequest extends Request
{
    /**
     * Voeg urenregistraties toe in batch.
     *
     * @param array<array{
     *     UserId?: int,
     *     PeriodId?: int|null,
     *     Date?: string,
     *     ActivityId?: int,
     *     ITSTaskId?: int|null,
     *     CRMProjectId?: int|null,
     *     ITSIssueId?: int|null,
     *     Description?: string|null,
     *     Minutes?: int,
     *     CreatePeriod?: bool,
     *     PeriodeStatusId?: int|null,
     *     RowIsAddedToPeriod?: bool,
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
