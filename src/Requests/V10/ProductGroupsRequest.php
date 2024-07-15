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
     *     IsTopLevelGroup?: boolean|null,
     *     Name?: string|null,
     *     IsVisibleOnWebShop?: boolean|null,
     *     ParentId?: integer|null,
     *     HasProductsVisibleOnWebshop?: boolean|null,
     *     ProductGroupTypeId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     GlobalisationId?: integer|null,
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
