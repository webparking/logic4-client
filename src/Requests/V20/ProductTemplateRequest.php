<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V20;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V20\ProductTemplatesWithTranslationLogic4Response;

class ProductTemplateRequest extends Request
{
    /**
     * @param array{
     *     ProductIds?: array<int>,
     *     VisibleOnWebsite?: bool|null,
     *     Skip?: int|null,
     *     Take?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplateValuesWithTranslations(
        array $parameters = [],
    ): ProductTemplatesWithTranslationLogic4Response {
        return ProductTemplatesWithTranslationLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/ProductTemplates/GetProductTemplateValuesWithTranslations', ['json' => $parameters]),
            )
        );
    }
}
