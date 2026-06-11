<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfCRMActivity;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfCRMActivityStatus;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfCRMActivityType;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfCRMProject;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfCRMProjectStatus;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfCRMProjectType;

class CRMRequest extends Request
{
    /**
     * Verkrijg CRM activiteiten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     *
     * @param array{
     *     CrmProjectId?: int|null,
     *     CreatedDateFrom?: string|null,
     *     CreatedDateTo?: string|null,
     *     StatusIds?: array<int>,
     *     CreatedByUserIds?: array<int>,
     *     CarriedOutByUserId?: int|null,
     *     StartDateFrom?: string|null,
     *     StartDateTo?: string|null,
     *     Name?: string|null,
     *     TypeId?: int|null,
     *     CrmProjectStatusId?: int|null,
     *     CrmProjectTypeId?: int|null,
     *     CrmProjectName?: string|null,
     *     ShowOnlyOpenActivities?: bool|null,
     *     UserIdForRights?: int|null,
     *     CarriedOutByUserIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getCRMActivities(
        array $parameters = [],
    ): Logic4ResponseListOfCRMActivity {
        return Logic4ResponseListOfCRMActivity::make(
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
    public function getCRMActivityStatusses(
    ): Logic4ResponseListOfCRMActivityStatus {
        return Logic4ResponseListOfCRMActivityStatus::make(
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
    public function getCRMActivityTypes(): Logic4ResponseListOfCRMActivityType
    {
        return Logic4ResponseListOfCRMActivityType::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/CRM/GetCRMActivityTypes'),
            )
        );
    }

    /**
     * Verkrijg CRM projecten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     *
     * @param array{
     *     CrmProjectId?: int|null,
     *     StartDate?: string|null,
     *     EndDate?: string|null,
     *     StatusIds?: array<int>,
     *     ResponsibleUserIds?: array<int>,
     *     Name?: string|null,
     *     TypeId?: int|null,
     *     UserIdForRights?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getCRMProjects(
        array $parameters = [],
    ): Logic4ResponseListOfCRMProject {
        return Logic4ResponseListOfCRMProject::make(
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
    public function getCRMProjectStatusses(): Logic4ResponseListOfCRMProjectStatus
    {
        return Logic4ResponseListOfCRMProjectStatus::make(
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
    public function getCRMProjectTypes(): Logic4ResponseListOfCRMProjectType
    {
        return Logic4ResponseListOfCRMProjectType::make(
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
    public function getCRMProjectTypes2(): Logic4ResponseListOfCRMProjectType
    {
        return Logic4ResponseListOfCRMProjectType::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/CRM/GetCRMProjectTypes2'),
            )
        );
    }
}
