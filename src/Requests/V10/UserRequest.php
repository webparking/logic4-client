<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfApiUser;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfstring;

class UserRequest extends Request
{
    /**
     * Haal alle gebruikers op.
     *
     * @throws Logic4ApiException
     */
    public function getAllUsers(): Logic4ResponseListOfApiUser
    {
        return Logic4ResponseListOfApiUser::make(
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
    public function getNotice(): Logic4ResponseOfstring
    {
        return Logic4ResponseOfstring::make(
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
    public function updateNotice(mixed $value): Logic4ResponseOfstring
    {
        return Logic4ResponseOfstring::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/User/UpdateNotice', ['json' => $value]),
            )
        );
    }
}
