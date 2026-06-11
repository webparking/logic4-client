<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\ITSIssue;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfITSFreeValue;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfITSIssueGroup;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfITSIssueLevel;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfITSIssueStatus;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfITSIssueType;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfITSProject;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfITSTaskPriority;

class ITSRequest extends Request
{
    /** @throws Logic4ApiException */
    public function getFreeValues1(): Logic4ResponseListOfITSFreeValue
    {
        return Logic4ResponseListOfITSFreeValue::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetFreeValues1'),
            )
        );
    }

    /** @throws Logic4ApiException */
    public function getFreeValues2(): Logic4ResponseListOfITSFreeValue
    {
        return Logic4ResponseListOfITSFreeValue::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetFreeValues2'),
            )
        );
    }

    /** @throws Logic4ApiException */
    public function getFreeValues3(): Logic4ResponseListOfITSFreeValue
    {
        return Logic4ResponseListOfITSFreeValue::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetFreeValues3'),
            )
        );
    }

    /** @throws Logic4ApiException */
    public function getIssueGroups(): Logic4ResponseListOfITSIssueGroup
    {
        return Logic4ResponseListOfITSIssueGroup::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetIssueGroups'),
            )
        );
    }

    /** @throws Logic4ApiException */
    public function getIssueLevels(): Logic4ResponseListOfITSIssueLevel
    {
        return Logic4ResponseListOfITSIssueLevel::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetIssueLevels'),
            )
        );
    }

    /**
     * Verkrijg ITS issues o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     *
     * @param array{
     *     Id?: int|null,
     *     StartDate?: string|null,
     *     EndDate?: string|null,
     *     LastModifiedSince?: string|null,
     *     DebtorId?: int|null,
     *     CreditorId?: int|null,
     *     InvoiceId?: int|null,
     *     StatusId?: int|null,
     *     ResponsibleUserId?: int|null,
     *     IssueMustBeCompletedTo?: string|null,
     *     IssueMustBeCompletedFrom?: string|null,
     *     TypeId?: int|null,
     *     GroupId?: int|null,
     *     ProjectId?: int|null,
     *     OrderId?: int|null,
     *     SkipRecords?: int|null,
     *     TakeRecords?: int|null,
     * } $parameters
     *
     * @return \Generator<array-key, ITSIssue>
     *
     * @throws Logic4ApiException
     */
    public function getIssues(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/ITS/GetIssues', $parameters);

        foreach ($iterator as $record) {
            yield ITSIssue::make($record);
        }
    }

    /** @throws Logic4ApiException */
    public function getIssueStatusses(): Logic4ResponseListOfITSIssueStatus
    {
        return Logic4ResponseListOfITSIssueStatus::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetIssueStatusses'),
            )
        );
    }

    /** @throws Logic4ApiException */
    public function getIssueTypes(): Logic4ResponseListOfITSIssueType
    {
        return Logic4ResponseListOfITSIssueType::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetIssueTypes'),
            )
        );
    }

    /**
     * Verkrijg ITS projecten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     *
     * @throws Logic4ApiException
     */
    public function getProjects(): Logic4ResponseListOfITSProject
    {
        return Logic4ResponseListOfITSProject::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetProjects'),
            )
        );
    }

    /** @throws Logic4ApiException */
    public function getTaskPriorities(): Logic4ResponseListOfITSTaskPriority
    {
        return Logic4ResponseListOfITSTaskPriority::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetTaskPriorities'),
            )
        );
    }
}
