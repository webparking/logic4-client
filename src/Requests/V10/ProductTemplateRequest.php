<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\ProductTemplate;
use Webparking\Logic4Client\Data\V10\ProductTemplateProductValue;
use Webparking\Logic4Client\Data\V10\ProductTemplateProperty;
use Webparking\Logic4Client\Data\V10\ProductTemplateValuesWithTranslation;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;

class ProductTemplateRequest extends Request
{
    /**
     * @param array{
     *     TemplatePropertyId?: integer|null,
     *     TemplateId?: integer|null,
     *     Remarks?: string|null,
     *     Skip?: integer|null,
     *     Take?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductTemplateProperty>
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplateProperties(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/ProductTemplates/GetProductTemplateProperties', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield ProductTemplateProperty::make($record);
        }
    }

    /**
     * Haal meerdere artikel templates op.
     *
     * @param array{
     *     TemplateId?: integer|null,
     *     TemplatePropertyId?: integer|null,
     *     Skip?: integer|null,
     *     Take?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductTemplate>
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplates(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/ProductTemplates/GetProductTemplates', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield ProductTemplate::make($record);
        }
    }

    /**
     * @param array{
     *     ProductIds?: array<integer>|null,
     *     VisibleOnWebsite?: boolean|null,
     *     Skip?: integer|null,
     *     Take?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductTemplateProductValue>
     *
     * @throws Logic4ApiException
     */
    public function getProductTemplateValuesPerProducts(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/ProductTemplates/GetProductTemplateValuesPerProducts', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield ProductTemplateProductValue::make($record);
        }
    }

    /**
     * @param array{
     *     ProductIds?: array<integer>|null,
     *     VisibleOnWebsite?: boolean|null,
     *     Skip?: integer|null,
     *     Take?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, ProductTemplateValuesWithTranslation>
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v2.0. - Artikel template waarden met vertalingen
     */
    public function getProductTemplateValuesWithTranslations(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/ProductTemplates/GetProductTemplateValuesWithTranslations', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield ProductTemplateValuesWithTranslation::make($record);
        }
    }

    /**
     * @param array{
     *     TemplatePropertyId?: integer|null,
     *     PropertyValuesPerProduct?: array<array{ProductId?: integer, Values?: array<string>}>|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function setProductTemplatePropertyValues(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/ProductTemplates/SetProductTemplatePropertyValues', ['json' => $parameters]),
            )
        );
    }
}
