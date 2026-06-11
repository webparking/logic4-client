<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfWebsiteDomain;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfWebsiteDomain;

class WebsiteDomainRequest extends Request
{
    /**
     * Verkrijg een websitedomein o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     Url?: string|null,
     *     IsStandardDomain?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebSiteDomain(
        array $parameters = [],
    ): Logic4ResponseOfWebsiteDomain {
        return Logic4ResponseOfWebsiteDomain::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/WebsiteDomains/GetWebSiteDomain', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle websitedomeinen.
     *
     * @throws Logic4ApiException
     */
    public function getWebSiteDomains(): Logic4ResponseListOfWebsiteDomain
    {
        return Logic4ResponseListOfWebsiteDomain::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/WebsiteDomains/GetWebSiteDomains'),
            )
        );
    }
}
