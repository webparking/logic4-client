<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\ProductTemplate;
use Webparking\Logic4Client\Responses\V30\ProductTemplateProductValue;
use Webparking\Logic4Client\Responses\V30\ProductTemplateProperty;
use Webparking\Logic4Client\Responses\V30\ProductTemplatesWithTranslation;

class ProductTemplateRequest extends Request
{
    /**
     * @param array{
     *     TemplatePropertyId?: int|null,
     *     TemplateId?: int|null,
     *     Remarks?: string|null,
     *     Skip?: int|null,
     *     Take?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductTemplateProperty>
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplateProperties(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductTemplateProperty::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/ProductTemplates/GetProductTemplateProperties', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Haal meerdere artikel templates op.
     *
     * @param array{
     *     TemplateId?: int|null,
     *     TemplatePropertyId?: int|null,
     *     Skip?: int|null,
     *     Take?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductTemplate>
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplates(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductTemplate::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/ProductTemplates/GetProductTemplates', ['json' => $parameters]),
            ),
        );
    }

    /**
     * @param array{
     *     ProductIds?: array<int>,
     *     VisibleOnWebsite?: bool|null,
     *     Skip?: int|null,
     *     Take?: int|null,
     * } $parameters
     *
     * @return array<array-key, ProductTemplateProductValue>
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplateValuesPerProducts(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductTemplateProductValue::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/ProductTemplates/GetProductTemplateValuesPerProducts', ['json' => $parameters]),
            ),
        );
    }

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
    ): ProductTemplatesWithTranslation {
        return ProductTemplatesWithTranslation::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/ProductTemplates/GetProductTemplateValuesWithTranslations', ['json' => $parameters]),
            )
        );
    }

    /**
     * @param array{
     *     TemplatePropertyId?: int,
     *     PropertyValuesPerProduct?: array<array{ProductId?: int, Values?: array<string>}>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function setProductTemplatePropertyValues(array $parameters = []): void
    {
        $this->getClient()->post('/v3/ProductTemplates/SetProductTemplatePropertyValues', ['json' => $parameters]);
    }
}
