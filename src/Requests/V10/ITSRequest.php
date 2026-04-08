<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\ITSIssue;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\ITSFreeValueLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ITSIssueGroupLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ITSIssueLevelLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ITSIssueStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ITSIssueTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ITSProjectLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ITSTaskPriorityLogic4ResponseList;

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
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v3.0. - ITS issues ophalen o.b.v. filter
     */
    public function getIssues(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/ITS/GetIssues', $parameters);

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
