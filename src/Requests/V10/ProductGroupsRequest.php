<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\ProductGroupLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductGroupTypeLogic4ResponseList;

class ProductGroupsRequest extends Request
{
    /**
     * Verkrijg artikelgroepen o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     IsTopLevelGroup?: bool|null,
     *     Name?: string|null,
     *     IsVisibleOnWebShop?: bool|null,
     *     ParentId?: int|null,
     *     HasProductsVisibleOnWebshop?: bool|null,
     *     ProductGroupTypeId?: int|null,
     *     WebsiteDomainId?: int|null,
     *     GlobalisationId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Artikelgroepen
     */
    public function getProductGroups(
        array $parameters = [],
    ): ProductGroupLogic4ResponseList {
        return ProductGroupLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/ProductGroups/GetProductGroups', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle artikelgroep types.
     *
     * @throws Logic4ApiException
     */
    public function getProductGroupTypes(): ProductGroupTypeLogic4ResponseList
    {
        return ProductGroupTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ProductGroups/GetProductGroupTypes'),
            )
        );
    }
}
