<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\SubscriberLogic4ResponseList;

class Marketing extends Request
{
    /**
     * Verkrijg abonnees op basis van het opgestuurde filter.
     *
     * @param array{
     *     DateTimeSubscribedFrom?: string,
     *     DateTimeSubscribedTo?: string,
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
