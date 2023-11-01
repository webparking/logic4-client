<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\HRMTimeRegistrationRowListLogic4Response;

class HRM extends Request
{
    /**
     * Voeg urenregistraties toe in batch.
     *
     * @throws Logic4ApiException
     */
    public function addTimeRegistrations(): HRMTimeRegistrationRowListLogic4Response
    {
        return HRMTimeRegistrationRowListLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/HRM/AddTimeRegistrations'),
            )
        );
    }
}
