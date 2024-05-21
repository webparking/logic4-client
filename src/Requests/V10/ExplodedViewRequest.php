<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\ExplodedView;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class ExplodedViewRequest extends Request
{
    /**
     * Verkrijg exploded view o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     ExplodedViewIds?: array<integer>|null,
     *     ProductGroupIds?: array<integer>|null,
     *     ProductIds?: array<integer>|null,
     *     GlobalisationIds?: array<integer>|null,
     *     WebsiteDomainId?: integer|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ExplodedView>
     *
     * @throws Logic4ApiException
     */
    public function getExplodedViews(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/ExplodedViews/GetExplodedViews', $parameters);

        foreach ($iterator as $record) {
            yield ExplodedView::make($record);
        }
    }
}
