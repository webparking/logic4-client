<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\WebsiteAlias;
use Webparking\Logic4Client\Responses\V30\WebsiteDomain;

class WebsiteDomainRequest extends Request
{
    /**
     * Verkrijg aliases o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     GlobalisationId?: int,
     *     WebsiteDomainId?: int|null,
     *     ProductId?: int|null,
     *     BrandId?: int|null,
     *     ProductGroupId?: int|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return array<array-key, WebsiteAlias>
     *
     * @throws Logic4ApiException
     */
    public function getAliases(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => WebsiteAlias::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/WebsiteDomains/GetAliases', ['json' => $parameters]),
            ),
        );
    }

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
    public function getWebSiteDomain(array $parameters = []): WebsiteDomain
    {
        return WebsiteDomain::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/WebsiteDomains/GetWebSiteDomain', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle websitedomeinen.
     *
     * @return array<array-key, WebsiteDomain>
     *
     * @throws Logic4ApiException
     */
    public function getWebSiteDomains(): array
    {
        return array_map(
            static fn (array $data) => WebsiteDomain::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/WebsiteDomains/GetWebSiteDomains'),
            ),
        );
    }
}
