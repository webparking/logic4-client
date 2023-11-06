<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\WebshopOrderlistProduct;
use Webparking\Logic4Client\Data\WebshopSearchWord;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\DecimalNullableLogic4Response;
use Webparking\Logic4Client\Responses\Int32Logic4Response;
use Webparking\Logic4Client\Responses\PaymentMethodLogic4ResponseList;
use Webparking\Logic4Client\Responses\ProductShiftPriceLogic4ResponseList;
use Webparking\Logic4Client\Responses\ShippingMethodLogic4ResponseList;
use Webparking\Logic4Client\Responses\WebshopUserLogic4Response;
use Webparking\Logic4Client\Responses\WebshopUserProductLogic4ResponseList;
use Webparking\Logic4Client\Responses\WebshopUserProductTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\WebshopUserTypeLogic4ResponseList;

class WebshopRequest extends Request
{
    /**
     * Voeg een WebshopUserProduct toe aan een WebshopUserProductlijst.
     *
     * @param array{
     *     Id?: integer|null,
     *     DateTimeAdded?: string|null,
     *     ProductId?: integer|null,
     *     QtyDec?: number|null,
     *     Commission?: string|null,
     *     ExcludedFromAnnualBudget?: boolean|null,
     *     ComposedProductParentId?: integer|null,
     *     TypeId?: integer|null,
     *     WebshopUserId?: integer|null,
     *     DebtorId?: integer|null,
     *     VisitorCode?: string|null,
     *     WebsiteDomainId?: integer|null,
     *     ShoppingCartKey?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addWebshopUserProductToWebshopUserProductList(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/AddWebshopUserProductToWebshopUserProductList', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een WebshopUserProductlijst.
     *
     * @param array{
     *     VisitorCode?: string|null,
     *     WebshopUserProductListType?: string|null,
     *     WebshopPricelistId?: integer|null,
     *     GetHighestShiftPrice?: boolean|null,
     *     CountryIdForSellPrice?: integer|null,
     *     BranchIdForSellPrice?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DebtorWebshopProductTypeId?: integer|null,
     *     DebtorId?: integer|null,
     *     WebshopUserId?: integer|null,
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
     * Verkrijg de betaalmethodes van een WebshopUser.
     *
     * @param array{
     *     DebtorId?: integer|null,
     *     ShippingMethodId?: integer|null,
     *     ShowOnlySelectedPaymentMethodDebtor?: boolean|null,
     *     TotalPrice?: number|null,
     *     ShowOnlyAfterPayments?: boolean|null,
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
     *     IsPureInclShop?: boolean|null,
     *     TotalPriceIncl?: number|null,
     *     DebtorId?: integer|null,
     *     CountryId?: integer|null,
     *     Weight?: number|null,
     *     TotalPrice?: number|null,
     *     Volume?: number|null,
     *     ShowOnlySelectedShippingMethodDebtor?: boolean|null,
     *     ShowOnlyShippingMethodsWithPaymentCondition?: boolean|null,
     *     ShowOnlyShippingMethodsWithPaymentConditionWithAfterPayments?: boolean|null,
     *     AddEmptyPackageWeightToWeight?: boolean|null,
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
     *     DebtorId?: integer|null,
     *     WebshopPriceListId?: integer|null,
     *     ProductId?: integer|null,
     *     MinSaleAmount?: integer|null,
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
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     SearchTerm?: string|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     GlobilizationId?: integer|null,
     *     DomainId?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, WebshopSearchWord>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopSearchWords(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Webshop/GetWebshopSearchWords', $parameters);

        foreach ($iterator as $record) {
            yield WebshopSearchWord::make($record);
        }
    }

    /**
     * Verkrijg webshopgebruiker o.b.v. webshopgebruikersnummer of debiteurnummer.
     *
     * @param array{
     *     DebtorId?: integer|null,
     *     WebshopUserId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUser(array $parameters = []): WebshopUserLogic4Response
    {
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
     *     WebshopUserId?: integer|null,
     *     IgnoreOrderstatusIds?: array<integer>|null,
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
     *     UserName?: string|null,
     *     Password?: string|null,
     *     WebsiteDomainId?: integer|null,
     *     IgnorePasswordCheck?: boolean|null,
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
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     WebshopUserProductListType?: integer|null,
     *     DebtorId?: integer|null,
     *     WebshopUserId?: integer|null,
     * } $parameters
     *
     * @return \Generator<array-key, WebshopOrderlistProduct>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserOrderlist(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.1/Webshop/GetWebshopUserOrderlist', $parameters);

        foreach ($iterator as $record) {
            yield WebshopOrderlistProduct::make($record);
        }
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
     *     WebshopUserProductListType?: string|null,
     *     WebshopPricelistId?: integer|null,
     *     GetHighestShiftPrice?: boolean|null,
     *     CountryIdForSellPrice?: integer|null,
     *     BranchIdForSellPrice?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DebtorWebshopProductTypeId?: integer|null,
     *     DebtorId?: integer|null,
     *     WebshopUserId?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserProductList(
        array $parameters = [],
    ): WebshopUserProductLogic4ResponseList {
        return WebshopUserProductLogic4ResponseList::make(
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
     * Maak van een winkelmandje een order aan.
     *
     * @param array{
     *     ShippingMethodId?: integer|null,
     *     PaymentMethodId?: integer|null,
     *     WebshopUserId?: integer|null,
     *     DebtorId?: integer|null,
     *     OrderDescription?: string|null,
     *     OrderReference?: string|null,
     *     OrderRemarks?: string|null,
     *     StatusId?: integer|null,
     *     ShippingCosts?: number|null,
     *     PriceListId?: integer|null,
     *     ShoppingCartKey?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function processShoppingCartToOrder(
        array $parameters = [],
    ): Int32Logic4Response {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/ProcessShoppingCartToOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Update het aantal van een WebshopUserProduct op een WebshopUserProductlijst.
     *
     * @param array{
     *     WebshopUserProductId?: integer|null,
     *     Qty?: integer|null,
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
