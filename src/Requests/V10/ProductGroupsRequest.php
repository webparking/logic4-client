<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductGroup;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductGroupType;

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
     */
    public function getProductGroups(
        array $parameters = [],
    ): Logic4ResponseListOfProductGroup {
        return Logic4ResponseListOfProductGroup::make(
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
    public function getProductGroupTypes(): Logic4ResponseListOfProductGroupType
    {
        return Logic4ResponseListOfProductGroupType::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/ProductGroups/GetProductGroupTypes'),
            )
        );
    }
}
