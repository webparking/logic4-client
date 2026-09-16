<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\ExplodedView;

class ExplodedViewsRequest extends Request
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
     * @return array<array-key, ExplodedView>
     *
     * @throws Logic4ApiException
     */
    public function getExplodedViews(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ExplodedView::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/ExplodedViews/GetExplodedViews', ['json' => $parameters]),
            ),
        );
    }
}
