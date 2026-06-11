<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfboolean;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfDatabaseConfiguration;

class BackOfficeRequest extends Request
{
    /**
     * Verkrijg de instellingen in de database configuratie.
     *
     * @throws Logic4ApiException
     */
    public function getDatabaseConfiguration(
    ): Logic4ResponseOfDatabaseConfiguration {
        return Logic4ResponseOfDatabaseConfiguration::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Backoffice/GetDatabaseConfiguration'),
            )
        );
    }

    /**
     * Maak een nieuwe taak aan.
     *
     * @param array{
     *     Type?: mixed,
     *     SerializedJson?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function postCreateBackofficeAction(
        array $parameters = [],
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Backoffice/PostCreateBackofficeAction', ['json' => $parameters]),
            )
        );
    }
}
