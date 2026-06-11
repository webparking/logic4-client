<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\Subscriber;

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
     * @return array<array-key, Subscriber>
     *
     * @throws Logic4ApiException
     */
    public function getSubscribers(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => Subscriber::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Marketing/GetSubscribers', ['json' => $parameters]),
            ),
        );
    }
}
