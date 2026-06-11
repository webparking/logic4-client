<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfAdministration;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfBranch;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfUserstatus;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfCompanyInformation;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfCompanyValues;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfstring;

class CompanyRequest extends Request
{
    /**
     * Verkrijg administraties waar de gebruiker toegang tot heeft.
     *
     * @throws Logic4ApiException
     */
    public function getAdministrationsForUser(
    ): Logic4ResponseListOfAdministration {
        return Logic4ResponseListOfAdministration::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Company/GetAdministrationsForUser'),
            )
        );
    }

    /**
     * Verkrijg alle filialen.
     *
     * @throws Logic4ApiException
     */
    public function getBranches(): Logic4ResponseListOfBranch
    {
        return Logic4ResponseListOfBranch::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Company/GetBranches'),
            )
        );
    }

    /**
     * Verkrijg bedrijfsgegevens voor de opgegeven administratie.
     *
     * @throws Logic4ApiException
     */
    public function getCompanyInformation(): Logic4ResponseOfCompanyInformation
    {
        return Logic4ResponseOfCompanyInformation::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Company/GetCompanyInformation'),
            )
        );
    }

    /**
     * Verkrijg algemene bedrijfsgegevens.
     *
     * @throws Logic4ApiException
     */
    public function getCompanyValues(): Logic4ResponseOfCompanyValues
    {
        return Logic4ResponseOfCompanyValues::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Company/GetCompanyValues'),
            )
        );
    }

    /**
     * Haal de algemene notitie van het bedrijf op.
     *
     * @throws Logic4ApiException
     */
    public function getNotice(): Logic4ResponseOfstring
    {
        return Logic4ResponseOfstring::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Company/GetNotice'),
            )
        );
    }

    /**
     * Haal alle statussen van de gekoppelde gebruikers op.
     *
     * @throws Logic4ApiException
     */
    public function getUserStatuses(): Logic4ResponseListOfUserstatus
    {
        return Logic4ResponseListOfUserstatus::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Company/GetUserStatuses'),
            )
        );
    }
}
