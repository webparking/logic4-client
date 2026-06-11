<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V20;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V20\Logic4ResponseListOfProductStockInformationV2;
use Webparking\Logic4Client\Responses\V20\Logic4ResponseOfint;

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
    ): Logic4ResponseOfint {
        return Logic4ResponseOfint::make(
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
    ): Logic4ResponseListOfProductStockInformationV2 {
        return Logic4ResponseListOfProductStockInformationV2::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/Stock/GetStockInformationForProduct', ['json' => $parameters]),
            )
        );
    }
}
