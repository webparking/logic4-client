<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\ApiUser;

class UserRequest extends Request
{
    /**
     * Haal alle gebruikers op.
     *
     * @return array<array-key, ApiUser>
     *
     * @throws Logic4ApiException
     */
    public function getAllUsers(): array
    {
        return array_map(
            static fn (array $data) => ApiUser::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/User/GetAllUsers'),
            ),
        );
    }

    /**
     * Notitie van de meegestuurde gebruiker.
     *
     * @throws Logic4ApiException
     */
    public function getNotice(): string
    {
        return $this->buildResponse(
            $this->getClient()->get('/v3/User/GetNotice'),
        );
    }

    /**
     * Update de notitie van gebruiker.
     *
     * @throws Logic4ApiException
     */
    public function updateNotice(mixed $value): void
    {
        $this->getClient()->post('/v3/User/UpdateNotice', ['json' => $value]);
    }
}
