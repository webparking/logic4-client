<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;

class BackOfficeRequest extends Request
{
    /**
     * Maak een nieuwe taak aan.
     *
     * @param array{
     *     Type?: string|null,
     *     SerializedJson?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function postCreateBackofficeAction(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Backoffice/PostCreateBackofficeAction', ['json' => $parameters]),
            )
        );
    }
}
