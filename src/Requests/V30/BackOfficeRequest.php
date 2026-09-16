<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\DatabaseConfiguration;

class BackOfficeRequest extends Request
{
    /**
     * Verkrijg de instellingen in de database configuratie.
     *
     * @throws Logic4ApiException
     */
    public function getDatabaseConfiguration(): DatabaseConfiguration
    {
        return DatabaseConfiguration::make(
            $this->buildResponse(
                $this->getClient()->get('/v3/Backoffice/GetDatabaseConfiguration'),
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
    public function postCreateBackofficeAction(array $parameters = []): void
    {
        $this->getClient()->post('/v3/Backoffice/PostCreateBackofficeAction', ['json' => $parameters]);
    }
}
