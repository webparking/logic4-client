<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\WebsiteDomainLogic4Response;
use Webparking\Logic4Client\Responses\WebsiteDomainLogic4ResponseList;

class WebsiteDomainRequest extends Request
{
    /**
     * Verkrijg een websitedomein o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     Url?: string|null,
     *     IsStandardDomain?: boolean|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebSiteDomain(
        array $parameters = [],
    ): WebsiteDomainLogic4Response {
        return WebsiteDomainLogic4Response::make(
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
    public function getWebSiteDomains(): WebsiteDomainLogic4ResponseList
    {
        return WebsiteDomainLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/WebsiteDomains/GetWebSiteDomains'),
            )
        );
    }
}
