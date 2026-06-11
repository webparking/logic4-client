<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V10;

use Webparking\Logic4Client\Data\V10\WebshopVisitorBehaviour;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfPaymentMethod;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfProductShiftPrice;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfShippingMethod;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfWebshopOrderlistProduct;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfWebshopSearchWord;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfWebshopUserProductOfProductV11;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfWebshopUserProductType;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfWebshopUserType;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfboolean;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfdecimal;
use Webparking\Logic4Client\Responses\V10\Logic4ResponseOfWebshopUser;

class WebshopRequest extends Request
{
    /**
     * Verwijder een WebshopUserProductlijst.
     *
     * @param array{
     *     VisitorCode?: string|null,
     *     WebshopUserProductListType?: mixed,
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
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
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
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Webshop/DeleteWebshopUserProductOnWebshopUserProductList', ['json' => $value]),
            )
        );
    }

    /**
     * Verkrijg webshopgebruikergedrag o.b.v. diverse filters (zie eindpunt /Webshop/GetWebshopUserProductListTypes voor de beschikbare types).
     * Wanneer het type "LastViewed" is geselecteerd, houd er dan rekening mee dat alleen de laatste 8 bekeken artikelen worden opgeslagen.
     * Wanneer een samengesteld artikel tot de collectie behoort, wordt alleen dit moederartikel in de aangegeven hoeveelheid getoond;
     * de aantallen kindartikelen zijn altijd in verhouding tot 1 moederartikel.
     *
     * @param array{
     *     WebshopUserProductListType?: mixed,
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
    ): Logic4ResponseListOfPaymentMethod {
        return Logic4ResponseListOfPaymentMethod::make(
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
    ): Logic4ResponseListOfShippingMethod {
        return Logic4ResponseListOfShippingMethod::make(
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
    ): Logic4ResponseListOfProductShiftPrice {
        return Logic4ResponseListOfProductShiftPrice::make(
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
     */
    public function getWebshopSearchWords(
        array $parameters = [],
    ): Logic4ResponseListOfWebshopSearchWord {
        return Logic4ResponseListOfWebshopSearchWord::make(
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
    ): Logic4ResponseOfWebshopUser {
        return Logic4ResponseOfWebshopUser::make(
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
    ): Logic4ResponseOfdecimal {
        return Logic4ResponseOfdecimal::make(
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
     *     WebsiteDomainId?: int|null,
     *     IgnorePasswordCheck?: bool,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserByLogin(
        array $parameters = [],
    ): Logic4ResponseOfWebshopUser {
        return Logic4ResponseOfWebshopUser::make(
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
     */
    public function getWebshopUserOrderlist(
        array $parameters = [],
    ): Logic4ResponseListOfWebshopOrderlistProduct {
        return Logic4ResponseListOfWebshopOrderlistProduct::make(
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
    ): Logic4ResponseListOfWebshopUserProductType {
        return Logic4ResponseListOfWebshopUserProductType::make(
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
     *     WebshopUserProductListType?: mixed,
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
    public function getWebshopUserProductList(
        array $parameters = [],
    ): Logic4ResponseListOfWebshopUserProductOfProductV11 {
        return Logic4ResponseListOfWebshopUserProductOfProductV11::make(
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
    ): Logic4ResponseListOfWebshopUserProductType {
        return Logic4ResponseListOfWebshopUserProductType::make(
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
    public function getWebShopUserTypes(): Logic4ResponseListOfWebshopUserType
    {
        return Logic4ResponseListOfWebshopUserType::make(
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
    ): Logic4ResponseOfboolean {
        return Logic4ResponseOfboolean::make(
            $this->buildResponse(
                $this->getClient()->put('/v1/Webshop/UpdateQtyWebshopUserProduct', ['json' => $parameters]),
            )
        );
    }
}
