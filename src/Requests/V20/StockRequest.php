<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V20;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V20\Int32Logic4Response;
use Webparking\Logic4Client\Responses\V20\ProductStockInformationV2Logic4ResponseList;

class StockRequest extends Request
{
    /**
     * Maak een voorraadmutatie aan.
     *
     * @param array{
     *     LedgerId?: int|null,
     *     ITS_IssueId?: int|null,
     *     ProductId?: int,
     *     Amount?: number,
     *     Remarks?: string|null,
     *     StockLocationId?: int,
     *     StockMutationTypeId?: int,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function createProductStockMutation(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/Stock/CreateProductStockMutation', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal actuele voorraad op voor een artikel.
     *
     * @param array{
     *     ProductCode?: string|null,
     *     ProductIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getStockInformationForProduct(
        array $parameters = [],
    ): ProductStockInformationV2Logic4ResponseList {
        return ProductStockInformationV2Logic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/Stock/GetStockInformationForProduct', ['json' => $parameters]),
            )
        );
    }
}
