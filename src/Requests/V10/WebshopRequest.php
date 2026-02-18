<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\WebshopVisitorBehaviour;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\DecimalNullableLogic4Response;
use Webparking\Logic4Client\Responses\V10\PaymentMethodLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductShiftPriceLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ProductV11WebshopUserProductLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\ShippingMethodLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\WebshopOrderlistProductLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\WebshopSearchWordLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\WebshopUserLogic4Response;
use Webparking\Logic4Client\Responses\V10\WebshopUserProductTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\V10\WebshopUserTypeLogic4ResponseList;

class WebshopRequest extends Request
{
    /**
     * Verwijder een WebshopUserProductlijst.
     *
     * @param array{
     *     VisitorCode?: string|null,
     *     WebshopUserProductListType?: string,
     *     WebshopPricelistId?: int|null,
     *     GetHighestShiftPrice?: bool|null,
     *     CountryIdForSellPrice?: int|null,
     *     BranchIdForSellPrice?: int|null,
     *     WebsiteDomainId?: int|null,
     *     DebtorWebshopProductTypeId?: int|null,
     *     DebtorId?: int|null,
     *     WebshopUserId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteWebshopUserProductList(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/DeleteWebshopUserProductList', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een WebshopUserProduct op een WebshopUserProductlijst.
     *
     * @throws Logic4ApiException
     */
    public function deleteWebshopUserProductOnWebshopUserProductList(
        int $value,
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/DeleteWebshopUserProductOnWebshopUserProductList', ['json' => $value]),
            )
        );
    }

    /**
     * Wanneer het type "LastViewed" is geselecteerd, houd er dan rekening mee dat alleen de laatste 8 bekeken artikelen worden opgeslagen.
     * Wanneer een samengesteld artikel tot de collectie behoort, wordt alleen dit moederartikel in de aangegeven hoeveelheid getoond;
     * de aantallen kindartikelen zijn altijd in verhouding tot 1 moederartikel.
     *
     * @param array{
     *     WebshopUserProductListType?: string,
     *     WebsiteDomainId?: int|null,
     *     DebtorId?: int|null,
     *     FromCreatedDateTime?: string|null,
     *     FromLastModifiedDateTime?: string|null,
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     * } $parameters
     *
     * @return \Generator<array-key, WebshopVisitorBehaviour>
     *
     * @throws Logic4ApiException
     */
    public function getVisitorBehaviorForDebtor(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1/Webshop/GetVisitorBehaviorForDebtor', $parameters);

        foreach ($iterator as $record) {
            yield WebshopVisitorBehaviour::make($record);
        }
    }

    /**
     * Verkrijg de betaalmethodes van een WebshopUser.
     *
     * @param array{
     *     DebtorId?: int,
     *     ShippingMethodId?: int,
     *     ShowOnlySelectedPaymentMethodDebtor?: bool|null,
     *     TotalPrice?: number,
     *     ShowOnlyAfterPayments?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopCheckOutPaymentMethods(
        array $parameters = [],
    ): PaymentMethodLogic4ResponseList {
        return PaymentMethodLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/GetWebshopCheckOutPaymentMethods', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de aflevermethodes van een WebshopUser.
     *
     * @param array{
     *     IsPureInclShop?: bool,
     *     TotalPriceIncl?: number|null,
     *     DebtorId?: int,
     *     CountryId?: int,
     *     PostalCode?: string|null,
     *     Weight?: number,
     *     TotalPrice?: number,
     *     Volume?: number,
     *     ShowOnlySelectedShippingMethodDebtor?: bool|null,
     *     ShowOnlyShippingMethodsWithPaymentCondition?: bool|null,
     *     ShowOnlyShippingMethodsWithPaymentConditionWithAfterPayments?: bool|null,
     *     AddEmptyPackageWeightToWeight?: bool|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopCheckOutShippingMethods(
        array $parameters = [],
    ): ShippingMethodLogic4ResponseList {
        return ShippingMethodLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/GetWebshopCheckOutShippingMethods', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg productprijzen o.b.v. webshopprijslijst/debiteur.
     *
     * @param array{
     *     DebtorId?: int,
     *     WebshopPriceListId?: int|null,
     *     ProductId?: int,
     *     MinSaleAmount?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopProductShiftPrices(
        array $parameters = [],
    ): ProductShiftPriceLogic4ResponseList {
        return ProductShiftPriceLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/GetWebshopProductShiftPrices', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg zoekresultaten van een webshop o.b.v. meegestuurde filter.
     *
     * @param array{
     *     SearchTerm?: string|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     GlobilizationId?: int|null,
     *     DomainId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Webshop zoekresultaten
     */
    public function getWebshopSearchWords(
        array $parameters = [],
    ): WebshopSearchWordLogic4ResponseList {
        return WebshopSearchWordLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/GetWebshopSearchWords', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg webshopgebruiker o.b.v. webshopgebruikersnummer of debiteurnummer.
     *
     * @param array{
     *     DebtorId?: int|null,
     *     WebshopUserId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUser(
        array $parameters = [],
    ): WebshopUserLogic4Response {
        return WebshopUserLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/GetWebshopUser', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg het nog te besteden bedrag voor een webshopgebruiker van een jaarbudget.
     *
     * @param array{
     *     WebshopUserId?: int,
     *     IgnoreOrderstatusIds?: array<int>,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserAvailableBudget(
        array $parameters = [],
    ): DecimalNullableLogic4Response {
        return DecimalNullableLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/GetWebshopUserAvailableBudget', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg webshopgebruiker o.b.v. meegestuurde credentials.
     *
     * @param array{
     *     UserName?: string,
     *     Password?: string,
     *     WebsiteDomainId?: int|null,
     *     IgnorePasswordCheck?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserByLogin(
        array $parameters = [],
    ): WebshopUserLogic4Response {
        return WebshopUserLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/GetWebshopUserByLogin', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg een bestellijst o.b.v. webshopgebruikersnummer of debiteurnummer voor de producttypes zie eindpunt /Webshop/GetWebshopUserOrderlistProductTypes.
     *
     * @param array{
     *     WebshopUserProductListType?: int|null,
     *     DebtorId?: int|null,
     *     WebshopUserId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Bestellijsten
     */
    public function getWebshopUserOrderlist(
        array $parameters = [],
    ): WebshopOrderlistProductLogic4ResponseList {
        return WebshopOrderlistProductLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/GetWebshopUserOrderlist', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de bestellijstproducttypes.
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserOrderlistProductTypes(
    ): WebshopUserProductTypeLogic4ResponseList {
        return WebshopUserProductTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Webshop/GetWebshopUserOrderlistProductTypes'),
            )
        );
    }

    /**
     * Verkrijg een WebshopUserProductlijst (Zie eindpunt /Webshop/GetWebshopUserProductListTypes voor de types) o.b.v. webshopgebruikersnummer of debiteurnummer.
     *
     * @param array{
     *     VisitorCode?: string|null,
     *     WebshopUserProductListType?: string,
     *     WebshopPricelistId?: int|null,
     *     GetHighestShiftPrice?: bool|null,
     *     CountryIdForSellPrice?: int|null,
     *     BranchIdForSellPrice?: int|null,
     *     WebsiteDomainId?: int|null,
     *     DebtorWebshopProductTypeId?: int|null,
     *     DebtorId?: int|null,
     *     WebshopUserId?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Versie 1.0 is verouderd. Gebruik versie v1.1. - Verkrijg een WebshopUserProductlijst
     */
    public function getWebshopUserProductList(
        array $parameters = [],
    ): ProductV11WebshopUserProductLogic4ResponseList {
        return ProductV11WebshopUserProductLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/GetWebshopUserProductList', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg de type WebshopUserProductlijsten.
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserProductListTypes(
    ): WebshopUserProductTypeLogic4ResponseList {
        return WebshopUserProductTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Webshop/GetWebshopUserProductListTypes'),
            )
        );
    }

    /**
     * Type webshopgebruikers.
     *
     * @throws Logic4ApiException
     */
    public function getWebShopUserTypes(): WebshopUserTypeLogic4ResponseList
    {
        return WebshopUserTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Webshop/GetWebShopUserTypes'),
            )
        );
    }

    /**
     * Update het aantal van een WebshopUserProduct op een WebshopUserProductlijst.
     *
     * @param array{
     *     WebshopUserProductId?: int,
     *     Qty?: int|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateQtyWebshopUserProduct(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->put('/v1/Webshop/UpdateQtyWebshopUserProduct', ['json' => $parameters]),
            )
        );
    }
}
