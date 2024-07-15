<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\CRMActivityLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\CRMActivityStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\CRMActivityTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\CRMProjectLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\CRMProjectStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\CRMProjectTypeLogic4ResponseList;

class CRMRequest extends Request
{
    /**
     * Verkrijg CRM activiteiten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     *
     * @param array{
     *     CrmProjectId?: integer|null,
     *     CreatedDateFrom?: string|null,
     *     CreatedDateTo?: string|null,
     *     StatusIds?: array<integer>|null,
     *     CreatedByUserIds?: array<integer>|null,
     *     CarriedOutByUserId?: integer|null,
     *     StartDateFrom?: string|null,
     *     StartDateTo?: string|null,
     *     Name?: string|null,
     *     TypeId?: integer|null,
     *     CrmProjectStatusId?: integer|null,
     *     CrmProjectTypeId?: integer|null,
     *     CrmProjectName?: string|null,
     *     ShowOnlyOpenActivities?: boolean|null,
     *     UserIdForRights?: integer|null,
     *     CarriedOutByUserIds?: array<integer>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - CRM activiteiten o.b.v. filter
     */
    public function getCRMActivities(
        array $parameters = [],
    ): CRMActivityLogic4ResponseList {
        return CRMActivityLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/CRM/GetCRMActivities', ['json' => $parameters]),
            )
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
     *     CrmProjectId?: integer|null,
     *     StartDate?: string|null,
     *     EndDate?: string|null,
     *     StatusIds?: array<integer>|null,
     *     ResponsibleUserIds?: array<integer>|null,
     *     Name?: string|null,
     *     TypeId?: integer|null,
     *     UserIdForRights?: integer|null,
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
