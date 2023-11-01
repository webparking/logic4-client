<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\ProductTemplateLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductTemplateProductValueLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductTemplatePropertyLogic4ResponseList;

class ProductTemplate extends Request
{
    /**
     * @param array{
     *     TemplatePropertyId?: integer,
     *     TemplateId?: integer,
     *     Remarks?: string,
     *     Skip?: integer,
     *     Take?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplateProperties(
        array $parameters = [],
    ): ProductTemplatePropertyLogic4ResponseList {
        return ProductTemplatePropertyLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/ProductTemplates/GetProductTemplateProperties', ['json' => $parameters]),
            )
        );
    }

    /**
     * Haal meerdere artikel templates op.
     *
     * @param array{
     *     TemplateId?: integer,
     *     TemplatePropertyId?: integer,
     *     Skip?: integer,
     *     Take?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplates(
        array $parameters = [],
    ): ProductTemplateLogic4ResponseList {
        return ProductTemplateLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/ProductTemplates/GetProductTemplates', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     ProductIds?: array<integer>,
     *     VisibleOnWebsite?: boolean,
     *     Skip?: integer,
     *     Take?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplateValuesPerProducts(
        array $parameters = [],
    ): ProductTemplateProductValueLogic4ResponseList {
        return ProductTemplateProductValueLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/ProductTemplates/GetProductTemplateValuesPerProducts', ['json' => $parameters]),
            )
        );
    }
}
