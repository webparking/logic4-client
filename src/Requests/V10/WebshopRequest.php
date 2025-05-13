<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\WebshopVisitorBehaviour;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\V10\DecimalNullableLogic4Response;
use Webparking\Logic4Client\Responses\V10\Int32Logic4Response;
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
     * Wanneer het type "LastViewed" is geselecteerd, houd er dan rekening mee dat alleen de laatste 8 bekeken artikelen worden opgeslagen.
     * Wanneer een samengesteld artikel tot de collectie behoort, wordt alleen dit moederartikel in de aangegeven hoeveelheid getoond;
     * de aantallen kindartikelen zijn altijd in verhouding tot 1 moederartikel.
     *
     * @param array{
     *     WebshopUserProductListType?: string|null,
     *     WebsiteDomainId?: integer|null,
     *     DebtorId?: integer|null,
     *     FromCreatedDateTime?: string|null,
     *     FromLastModifiedDateTime?: string|null,
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
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
     *     PostalCode?: string|null,
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
     *     SearchTerm?: string|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     GlobilizationId?: integer|null,
     *     DomainId?: integer|null,
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
     *     DebtorId?: integer|null,
     *     WebshopUserId?: integer|null,
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
     *     WebshopUserProductListType?: integer|null,
     *     DebtorId?: integer|null,
     *     WebshopUserId?: integer|null,
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
