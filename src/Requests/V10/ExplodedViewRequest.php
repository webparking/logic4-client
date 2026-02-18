<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\ExplodedView;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

class ExplodedViewRequest extends Request
{
    /**
     * Verkrijg exploded view o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     ExplodedViewIds?: array<int>,
     *     ProductGroupIds?: array<int>,
     *     ProductIds?: array<int>,
     *     GlobalisationIds?: array<int>,
     *     WebsiteDomainId?: int|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
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
