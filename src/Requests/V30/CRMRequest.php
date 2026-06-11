<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\CRMActivity;
use Webparking\Logic4Client\Responses\V30\CRMActivityStatus;
use Webparking\Logic4Client\Responses\V30\CRMActivityType;
use Webparking\Logic4Client\Responses\V30\CRMProject;
use Webparking\Logic4Client\Responses\V30\CRMProjectStatus;
use Webparking\Logic4Client\Responses\V30\CRMProjectType;

class CRMRequest extends Request
{
    /**
     * Verkrijg CRM activiteiten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     * De hoeveelheid activiteiten wordt gelimiteerd aan de hand van opgegeven SkipRecords en TakeRecords.
     * TakeRecords wordt gelimiteerd op 10.000.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
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
     * @return array<array-key, CRMActivity>
     *
     * @throws Logic4ApiException
     */
    public function getCRMActivities(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => CRMActivity::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/CRM/GetCRMActivities', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle beschikbare CRM activiteit statussen.
     *
     * @return array<array-key, CRMActivityStatus>
     *
     * @throws Logic4ApiException
     */
    public function getCRMActivityStatusses(): array
    {
        return array_map(
            static fn (array $data) => CRMActivityStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/CRM/GetCRMActivityStatusses'),
            ),
        );
    }

    /**
     * Verkrijg alle beschikbare CRM activiteit types.
     *
     * @return array<array-key, CRMActivityType>
     *
     * @throws Logic4ApiException
     */
    public function getCRMActivityTypes(): array
    {
        return array_map(
            static fn (array $data) => CRMActivityType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/CRM/GetCRMActivityTypes'),
            ),
        );
    }

    /**
     * Verkrijg CRM projecten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     * <br />
     * Let op: Vanaf V3 is het verplicht TakeRecords mee te sturen, met een maximum van 10.000.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
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
     * @return array<array-key, CRMProject>
     *
     * @throws Logic4ApiException
     */
    public function getCRMProjects(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => CRMProject::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/CRM/GetCRMProjects', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg alle beschikbare CRM projectstatussen.
     *
     * @return array<array-key, CRMProjectStatus>
     *
     * @throws Logic4ApiException
     */
    public function getCRMProjectStatusses(): array
    {
        return array_map(
            static fn (array $data) => CRMProjectStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/CRM/GetCRMProjectStatusses'),
            ),
        );
    }

    /**
     * Verkrijg alle beschikbare CRM projecttypes.
     *
     * @return array<array-key, CRMProjectType>
     *
     * @throws Logic4ApiException
     */
    public function getCRMProjectTypes(): array
    {
        return array_map(
            static fn (array $data) => CRMProjectType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/CRM/GetCRMProjectTypes'),
            ),
        );
    }

    /**
     * Verkrijg alle beschikbare CRM projecttypes 2.
     *
     * @return array<array-key, CRMProjectType>
     *
     * @throws Logic4ApiException
     */
    public function getCRMProjectTypes2(): array
    {
        return array_map(
            static fn (array $data) => CRMProjectType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/CRM/GetCRMProjectTypes2'),
            ),
        );
    }
}
