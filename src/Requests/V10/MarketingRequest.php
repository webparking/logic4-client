<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\SubscriberLogic4ResponseList;

class MarketingRequest extends Request
{
    /**
     * Verkrijg abonnees op basis van het opgestuurde filter.
     *
     * @param array{
     *     DateTimeSubscribedFrom?: string|null,
     *     DateTimeSubscribedTo?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getSubscribers(
        array $parameters = [],
    ): SubscriberLogic4ResponseList {
        return SubscriberLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Marketing/GetSubscribers', ['json' => $parameters]),
            )
        );
    }
}
