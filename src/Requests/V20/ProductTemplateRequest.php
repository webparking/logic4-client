<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V20;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V20\ProductTemplatesWithTranslation;

class ProductTemplateRequest extends Request
{
    /**
     * @param array{
     *     ProductIds?: array<integer>|null,
     *     VisibleOnWebsite?: boolean|null,
     *     Skip?: integer|null,
     *     Take?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplateValuesWithTranslations(
        array $parameters = [],
    ): ProductTemplatesWithTranslation {
        return ProductTemplatesWithTranslation::make(
            $this->buildResponse(
                $this->getClient()->post('/v2/ProductTemplates/GetProductTemplateValuesWithTranslations', ['json' => $parameters]),
            )
        );
    }
}
