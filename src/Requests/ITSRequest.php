<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\ITSIssue;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\ITSFreeValueLogic4ResponseList;
use Webparking\Logic4Client\Responses\ITSIssueGroupLogic4ResponseList;
use Webparking\Logic4Client\Responses\ITSIssueLevelLogic4ResponseList;
use Webparking\Logic4Client\Responses\ITSIssueStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\ITSIssueTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\ITSProjectLogic4ResponseList;
use Webparking\Logic4Client\Responses\ITSTaskPriorityLogic4ResponseList;

class ITSRequest extends Request
{
    /**
     * @throws Logic4ApiException
     */
    public function getFreeValues1(): ITSFreeValueLogic4ResponseList
    {
        return ITSFreeValueLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetFreeValues1'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getFreeValues2(): ITSFreeValueLogic4ResponseList
    {
        return ITSFreeValueLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetFreeValues2'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getFreeValues3(): ITSFreeValueLogic4ResponseList
    {
        return ITSFreeValueLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetFreeValues3'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getIssueGroups(): ITSIssueGroupLogic4ResponseList
    {
        return ITSIssueGroupLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetIssueGroups'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getIssueLevels(): ITSIssueLevelLogic4ResponseList
    {
        return ITSIssueLevelLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetIssueLevels'),
            )
        );
    }

    /**
     * Verkrijg ITS issues o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     *
     * @param array{
     *     Id?: integer|null,
     *     StartDate?: string|null,
     *     EndDate?: string|null,
     *     LastModifiedSince?: string|null,
     *     DebtorId?: integer|null,
     *     CreditorId?: integer|null,
     *     InvoiceId?: integer|null,
     *     StatusId?: integer|null,
     *     ResponsibleUserId?: integer|null,
     *     IssueMustBeCompletedTo?: string|null,
     *     IssueMustBeCompletedFrom?: string|null,
     *     TypeId?: integer|null,
     *     GroupId?: integer|null,
     *     ProjectId?: integer|null,
     *     OrderId?: integer|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ITSIssue>
     *
     * @throws Logic4ApiException
     */
    public function getIssues(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/ITS/GetIssues', $parameters);

        foreach ($iterator as $record) {
            yield ITSIssue::make($record);
        }
    }

    /**
     * @throws Logic4ApiException
     */
    public function getIssueStatusses(): ITSIssueStatusLogic4ResponseList
    {
        return ITSIssueStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetIssueStatusses'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getIssueTypes(): ITSIssueTypeLogic4ResponseList
    {
        return ITSIssueTypeLogic4ResponseList::make(
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
    public function getProjects(): ITSProjectLogic4ResponseList
    {
        return ITSProjectLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetProjects'),
            )
        );
    }

    /**
     * @throws Logic4ApiException
     */
    public function getTaskPriorities(): ITSTaskPriorityLogic4ResponseList
    {
        return ITSTaskPriorityLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ITS/GetTaskPriorities'),
            )
        );
    }
}
