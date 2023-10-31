<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\CRMActivity;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\CRMActivityStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\CRMActivityTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\CRMProjectLogic4ResponseList;
use Webparking\Logic4Client\Responses\CRMProjectStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\CRMProjectTypeLogic4ResponseList;

class CRM extends Request
{
    /**
     * Verkrijg CRM activiteiten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     * De hoeveelheid activiteiten wordt gelimiteerd aan de hand van opgegeven SkipRecords en TakeRecords.
     * TakeRecords wordt gelimiteerd op 10.000.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     CrmProjectId?: integer,
     *     CreatedDateFrom?: string,
     *     CreatedDateTo?: string,
     *     StatusIds?: array<integer>,
     *     CreatedByUserIds?: array<integer>,
     *     CarriedOutByUserId?: integer,
     *     StartDateFrom?: string,
     *     StartDateTo?: string,
     *     Name?: string,
     *     TypeId?: integer,
     *     CrmProjectStatusId?: integer,
     *     CrmProjectTypeId?: integer,
     *     CrmProjectName?: string,
     *     ShowOnlyOpenActivities?: boolean,
     *     UserIdForRights?: integer,
     *     CarriedOutByUserIds?: array<integer>,
     * } $parameters
     *
     * @return PaginatedResponse<CRMActivity>
     *
     * @throws Logic4ApiException
     */
    public function getCRMActivities(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/CRM/GetCRMActivities', $parameters),
            CRMActivity::class,
        );
    }

    /**
     * Verkrijg alle beschikbare CRM activiteit statussen.
     *
     * @throws Logic4ApiException
     */
    public function getCRMActivityStatusses(): CRMActivityStatusLogic4ResponseList
    {
        return CRMActivityStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/CRM/GetCRMActivityStatusses'),
            )
        );
    }

    /**
     * Verkrijg alle beschikbare CRM activiteit types.
     *
     * @throws Logic4ApiException
     */
    public function getCRMActivityTypes(): CRMActivityTypeLogic4ResponseList
    {
        return CRMActivityTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/CRM/GetCRMActivityTypes'),
            )
        );
    }

    /**
     * Verkrijg CRM projecten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     *
     * @param array{
     *     CrmProjectId?: integer,
     *     StartDate?: string,
     *     EndDate?: string,
     *     StatusIds?: array<integer>,
     *     ResponsibleUserIds?: array<integer>,
     *     Name?: string,
     *     TypeId?: integer,
     *     UserIdForRights?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getCRMProjects(
        array $parameters = [],
    ): CRMProjectLogic4ResponseList {
        return CRMProjectLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/CRM/GetCRMProjects', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle beschikbare CRM projectstatussen.
     *
     * @throws Logic4ApiException
     */
    public function getCRMProjectStatusses(): CRMProjectStatusLogic4ResponseList
    {
        return CRMProjectStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/CRM/GetCRMProjectStatusses'),
            )
        );
    }

    /**
     * Verkrijg alle beschikbare CRM projecttypes.
     *
     * @throws Logic4ApiException
     */
    public function getCRMProjectTypes(): CRMProjectTypeLogic4ResponseList
    {
        return CRMProjectTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/CRM/GetCRMProjectTypes'),
            )
        );
    }

    /**
     * Verkrijg alle beschikbare CRM projecttypes 2.
     *
     * @throws Logic4ApiException
     */
    public function getCRMProjectTypes2(): CRMProjectTypeLogic4ResponseList
    {
        return CRMProjectTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/CRM/GetCRMProjectTypes2'),
            )
        );
    }
}
