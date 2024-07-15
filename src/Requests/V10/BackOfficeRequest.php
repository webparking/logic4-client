<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\DatabaseConfigurationLogic4Response;

class BackOfficeRequest extends Request
{
    /**
     * Verkrijg de instellingen in de database configuratie.
     *
     * @throws Logic4ApiException
     */
    public function getDatabaseConfiguration(
    ): DatabaseConfigurationLogic4Response {
        return DatabaseConfigurationLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Backoffice/GetDatabaseConfiguration'),
            )
        );
    }

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
