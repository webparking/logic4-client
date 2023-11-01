<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\ApiUserLogic4ResponseList;
use Webparking\Logic4Client\Responses\StringLogic4Response;

class User extends Request
{
    /**
     * Haal alle gebruikers op.
     *
     * @throws Logic4ApiException
     */
    public function getAllUsers(): ApiUserLogic4ResponseList
    {
        return ApiUserLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/User/GetAllUsers'),
            )
        );
    }

    /**
     * Notitie van de meegestuurde gebruiker.
     *
     * @throws Logic4ApiException
     */
    public function getNotice(): StringLogic4Response
    {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/User/GetNotice'),
            )
        );
    }

    /**
     * Update de notitie van gebruiker.
     *
     * @throws Logic4ApiException
     */
    public function updateNotice(): StringLogic4Response
    {
        return StringLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/User/UpdateNotice'),
            )
        );
    }
}
