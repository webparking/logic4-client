<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V10\ProductPricelistLogic4ResponseList;

class PriceListsRequest extends Request
{
    /**
     * Verkrijg alle prijslijsten o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     PricelistId?: integer|null,
     *     DebtorId?: integer|null,
     *     LoadContractPrices?: boolean|null,
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
     *     PriceListId?: integer|null,
     *     ProductStaggeredPrices?: array<array{ProductId?: integer, Prices?: array<array{Qty?: integer, PriceEx?: number, DateFrom?: string|null, DateTo?: string|null}>|null}>|null,
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
