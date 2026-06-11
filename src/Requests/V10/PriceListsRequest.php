<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductPricelist;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfint;

class PriceListsRequest extends Request
{
    /**
     * Verkrijg alle prijslijsten o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     PricelistId?: int|null,
     *     DebtorId?: int|null,
     *     LoadContractPrices?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getPricelists(
        array $parameters = [],
    ): Logic4ResponseListOfProductPricelist {
        return Logic4ResponseListOfProductPricelist::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/PriceLists/GetPricelists', ['json' => $parameters]),
            )
        );
    }

    /**
     * Contractprijzen bijwerken binnen de prijslijst.
     *
     * @param array{
     *     PriceListId?: int,
     *     ProductStaggeredPrices?: array<array{ProductId?: int, Prices?: array<array{Qty?: int, PriceEx?: number, DateFrom?: string|null, DateTo?: string|null}>}>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updatePriceListForProducts(
        array $parameters = [],
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
            $this->buildResponse(
                $this->getClient()->put('/v1/PriceLists/UpdatePriceListForProducts', ['json' => $parameters]),
            )
        );
    }
}
