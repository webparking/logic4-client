<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\ITSFreeValue;
use Webparking\Logic4Client\Responses\V30\ITSIssue;
use Webparking\Logic4Client\Responses\V30\ITSIssueGroup;
use Webparking\Logic4Client\Responses\V30\ITSIssueLevel;
use Webparking\Logic4Client\Responses\V30\ITSIssueStatus;
use Webparking\Logic4Client\Responses\V30\ITSIssueType;
use Webparking\Logic4Client\Responses\V30\ITSProject;
use Webparking\Logic4Client\Responses\V30\ITSTaskPriority;

class ITSRequest extends Request
{
    /**
     * @return array<array-key, ITSFreeValue>
     *
     * @throws Logic4ApiException
     */
    public function getFreeValues1(): array
    {
        return array_map(
            static fn (array $data) => ITSFreeValue::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ITS/GetFreeValues1'),
            ),
        );
    }

    /**
     * @return array<array-key, ITSFreeValue>
     *
     * @throws Logic4ApiException
     */
    public function getFreeValues2(): array
    {
        return array_map(
            static fn (array $data) => ITSFreeValue::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ITS/GetFreeValues2'),
            ),
        );
    }

    /**
     * @return array<array-key, ITSFreeValue>
     *
     * @throws Logic4ApiException
     */
    public function getFreeValues3(): array
    {
        return array_map(
            static fn (array $data) => ITSFreeValue::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ITS/GetFreeValues3'),
            ),
        );
    }

    /**
     * @return array<array-key, ITSIssueGroup>
     *
     * @throws Logic4ApiException
     */
    public function getIssueGroups(): array
    {
        return array_map(
            static fn (array $data) => ITSIssueGroup::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ITS/GetIssueGroups'),
            ),
        );
    }

    /**
     * @return array<array-key, ITSIssueLevel>
     *
     * @throws Logic4ApiException
     */
    public function getIssueLevels(): array
    {
        return array_map(
            static fn (array $data) => ITSIssueLevel::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ITS/GetIssueLevels'),
            ),
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
     * @return array<array-key, ITSIssue>
     *
     * @throws Logic4ApiException
     */
    public function getIssues(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ITSIssue::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/ITS/GetIssues', ['json' => $parameters]),
            ),
        );
    }

    /**
     * @return array<array-key, ITSIssueStatus>
     *
     * @throws Logic4ApiException
     */
    public function getIssueStatusses(): array
    {
        return array_map(
            static fn (array $data) => ITSIssueStatus::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ITS/GetIssueStatusses'),
            ),
        );
    }

    /**
     * @return array<array-key, ITSIssueType>
     *
     * @throws Logic4ApiException
     */
    public function getIssueTypes(): array
    {
        return array_map(
            static fn (array $data) => ITSIssueType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ITS/GetIssueTypes'),
            ),
        );
    }

    /**
     * Verkrijg ITS projecten o.b.v. het meegestuurde filter en de opgegeven gebruiker.
     *
     * @return array<array-key, ITSProject>
     *
     * @throws Logic4ApiException
     */
    public function getProjects(): array
    {
        return array_map(
            static fn (array $data) => ITSProject::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ITS/GetProjects'),
            ),
        );
    }

    /**
     * @return array<array-key, ITSTaskPriority>
     *
     * @throws Logic4ApiException
     */
    public function getTaskPriorities(): array
    {
        return array_map(
            static fn (array $data) => ITSTaskPriority::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/ITS/GetTaskPriorities'),
            ),
        );
    }
}
