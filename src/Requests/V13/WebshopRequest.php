<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V13;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V13\BooleanLogic4Response;

class WebshopRequest extends Request
{
    /**
     * Voeg een WebshopUserProduct toe aan een WebshopUserProductlijst.
     *
     * @param array{
     *     ProductId?: int,
     *     QtyDec?: number|null,
     *     Commission?: string|null,
     *     ExcludedFromAnnualBudget?: bool,
     *     TypeId?: int,
     *     DebtorId?: int|null,
     *     VisitorCode?: string|null,
     *     WebsiteDomainId?: int|null,
     *     ShoppingCartKey?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addWebshopUserProductToWebshopUserProductList(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.3/Webshop/AddWebshopUserProductToWebshopUserProductList', ['json' => $parameters]),
            )
        );
    }
}
