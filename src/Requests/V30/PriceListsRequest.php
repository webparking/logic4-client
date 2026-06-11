<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\ProductPricelist;

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
     * @return array<array-key, ProductPricelist>
     *
     * @throws Logic4ApiException
     */
    public function getPricelists(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductPricelist::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/PriceLists/GetPricelists', ['json' => $parameters]),
            ),
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
    public function updatePriceListForProducts(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->put('/v3/PriceLists/UpdatePriceListForProducts', ['json' => $parameters]),
        );
    }
}
