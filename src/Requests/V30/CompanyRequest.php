<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\Administration;
use Webparking\Logic4Client\Responses\V30\Branch;
use Webparking\Logic4Client\Responses\V30\CompanyInformation;
use Webparking\Logic4Client\Responses\V30\CompanyValues;
use Webparking\Logic4Client\Responses\V30\Userstatus;

class CompanyRequest extends Request
{
    /**
     * Verkrijg administraties waar de gebruiker toegang tot heeft.
     *
     * @return array<array-key, Administration>
     *
     * @throws Logic4ApiException
     */
    public function getAdministrationsForUser(): array
    {
        return array_map(
            static fn (array $data) => Administration::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Company/GetAdministrationsForUser'),
            ),
        );
    }

    /**
     * Verkrijg alle filialen.
     *
     * @return array<array-key, Branch>
     *
     * @throws Logic4ApiException
     */
    public function getBranches(): array
    {
        return array_map(
            static fn (array $data) => Branch::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Company/GetBranches'),
            ),
        );
    }

    /**
     * Verkrijg bedrijfsgegevens voor de opgegeven administratie.
     *
     * @throws Logic4ApiException
     */
    public function getCompanyInformation(): CompanyInformation
    {
        return CompanyInformation::make(
            $this->buildResponse(
                $this->getClient()->get('/v3/Company/GetCompanyInformation'),
            )
        );
    }

    /**
     * Verkrijg algemene bedrijfsgegevens.
     *
     * @throws Logic4ApiException
     */
    public function getCompanyValues(): CompanyValues
    {
        return CompanyValues::make(
            $this->buildResponse(
                $this->getClient()->get('/v3/Company/GetCompanyValues'),
            )
        );
    }

    /**
     * Haal de algemene notitie van het bedrijf op.
     *
     * @throws Logic4ApiException
     */
    public function getNotice(): string
    {
        return $this->buildResponse(
            $this->getClient()->get('/v3/Company/GetNotice'),
        );
    }

    /**
     * Haal alle statussen van de gekoppelde gebruikers op.
     *
     * @return array<array-key, Userstatus>
     *
     * @throws Logic4ApiException
     */
    public function getUserStatuses(): array
    {
        return array_map(
            static fn (array $data) => Userstatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Company/GetUserStatuses'),
            ),
        );
    }
}
