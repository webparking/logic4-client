<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\ProductGroupLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductGroupTypeLogic4ResponseList;

class ProductGroups extends Request
{
    /**
     * Verkrijg artikelgroepen o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     IsTopLevelGroup?: boolean,
     *     Name?: string,
     *     IsVisibleOnWebShop?: boolean,
     *     ParentId?: integer,
     *     HasProductsVisibleOnWebshop?: boolean,
     *     ProductGroupTypeId?: integer,
     *     WebsiteDomainId?: integer,
     *     GlobalisationId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
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
