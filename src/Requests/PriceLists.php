<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\Int32Logic4Response;
use Webparking\Logic4Client\Responses\ProductPricelistLogic4ResponseList;

class PriceLists extends Request
{
    /**
     * Verkrijg alle prijslijsten o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     PricelistId?: integer,
     *     DebtorId?: integer,
     *     LoadContractPrices?: boolean,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getPricelists(
        array $parameters = [],
    ): ProductPricelistLogic4ResponseList {
        return ProductPricelistLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/PriceLists/GetPricelists', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     PriceListId?: integer,
     *     ProductStaggeredPrices?: array<mixed>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updatePriceListForProducts(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->put('/v1/PriceLists/UpdatePriceListForProducts', ['json' => $parameters]),
            )
        );
    }
}
