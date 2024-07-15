<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\AdministrationLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\BranchLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\CompanyInformationLogic4Response;
use Webparking\Logic4Client\Responses\V10\CompanyValuesLogic4Response;
use Webparking\Logic4Client\Responses\V10\StringLogic4Response;
use Webparking\Logic4Client\Responses\V10\UserstatusLogic4ResponseList;

class CompanyRequest extends Request
{
    /**
     * Verkrijg administraties waar de gebruiker toegang tot heeft.
     *
     * @throws Logic4ApiException
     */
    public function getAdministrationsForUser(): AdministrationLogic4ResponseList
    {
        return AdministrationLogic4ResponseList::make(
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
    public function getBranches(): BranchLogic4ResponseList
    {
        return BranchLogic4ResponseList::make(
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
    public function getCompanyInformation(): CompanyInformationLogic4Response
    {
        return CompanyInformationLogic4Response::make(
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
    public function getCompanyValues(): CompanyValuesLogic4Response
    {
        return CompanyValuesLogic4Response::make(
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
    public function getNotice(): StringLogic4Response
    {
        return StringLogic4Response::make(
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
    public function getUserStatuses(): UserstatusLogic4ResponseList
    {
        return UserstatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Company/GetUserStatuses'),
            )
        );
    }
}
