<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\ProductTemplate;
use Webparking\Logic4Client\Data\ProductTemplateProductValue;
use Webparking\Logic4Client\Data\ProductTemplateProperty;
use Webparking\Logic4Client\Data\ProductTemplateValuesWithTranslation;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;

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
     */
    public function getProductTemplateValuesWithTranslations(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/ProductTemplates/GetProductTemplateValuesWithTranslations', $parameters, 'Take', 'Skip');

        foreach ($iterator as $record) {
            yield ProductTemplateValuesWithTranslation::make($record);
        }
    }
}
