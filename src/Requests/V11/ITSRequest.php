<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\V11\ITSIssue;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class ITSRequest extends Request
{
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
        $iterator = $this->paginateRecords('/v1.1/ITS/GetIssues', $parameters);

        foreach ($iterator as $record) {
            yield ITSIssue::make($record);
        }
    }
}
