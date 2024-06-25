<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V11;

use Webparking\Logic4Client\Data\ITSIssue;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class ITSRequest extends Request
{
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
}
