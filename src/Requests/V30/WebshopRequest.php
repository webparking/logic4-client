<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V30;

use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V30\PaymentMethod;
use Webparking\Logic4Client\Responses\V30\ProductShiftPrice;
use Webparking\Logic4Client\Responses\V30\ShippingMethod;
use Webparking\Logic4Client\Responses\V30\WebshopOrderlistProduct;
use Webparking\Logic4Client\Responses\V30\WebshopSearchWord;
use Webparking\Logic4Client\Responses\V30\WebshopUser;
use Webparking\Logic4Client\Responses\V30\WebshopUserProductOfProductV12;
use Webparking\Logic4Client\Responses\V30\WebshopUserProductType;
use Webparking\Logic4Client\Responses\V30\WebshopUserType;
use Webparking\Logic4Client\Responses\V30\WebshopVisitorBehaviour;

class WebshopRequest extends Request
{
    /**
     * Voeg een WebshopUserProduct toe aan een WebshopUserProductlijst.
     *
     * @param array{
     *     ProductId?: int,
     *     QtyDec?: number|null,
     *     Commission?: string|null,
     *     ExcludedFromAnnualBudget?: bool,
     *     TypeId?: int,
     *     DebtorId?: int|null,
     *     VisitorCode?: string|null,
     *     WebsiteDomainId?: int|null,
     *     ShoppingCartKey?: string|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addWebshopUserProductToWebshopUserProductList(array $parameters = []): int
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Webshop/AddWebshopUserProductToWebshopUserProductList', ['json' => $parameters]),
        );
    }

    /**
     * Verwijder een WebshopUserProduct op een WebshopUserProductlijst.
     *
     * @throws Logic4ApiException
     */
    public function deleteWebshopUserProductOnWebshopUserProductList(int $value): void
    {
        $this->getClient()->post('/v3/Webshop/DeleteWebshopUserProductOnWebshopUserProductList', ['json' => $value]);
    }

    /**
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
     * @return array<array-key, WebshopVisitorBehaviour>
     *
     * @throws Logic4ApiException
     */
    public function getVisitorBehaviorForDebtor(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => WebshopVisitorBehaviour::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Webshop/GetVisitorBehaviorForDebtor', ['json' => $parameters]),
            ),
        );
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
     * @return array<array-key, PaymentMethod>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopCheckOutPaymentMethods(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => PaymentMethod::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Webshop/GetWebshopCheckOutPaymentMethods', ['json' => $parameters]),
            ),
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
     * @return array<array-key, ShippingMethod>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopCheckOutShippingMethods(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ShippingMethod::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Webshop/GetWebshopCheckOutShippingMethods', ['json' => $parameters]),
            ),
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
     * @return array<array-key, ProductShiftPrice>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopProductShiftPrices(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => ProductShiftPrice::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Webshop/GetWebshopProductShiftPrices', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg zoekresultaten van een webshop o.b.v. meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     SearchTerm?: string|null,
     *     DateFrom?: string|null,
     *     DateTo?: string|null,
     *     GlobilizationId?: int|null,
     *     DomainId?: int|null,
     * } $parameters
     *
     * @return array<array-key, WebshopSearchWord>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopSearchWords(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => WebshopSearchWord::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Webshop/GetWebshopSearchWords', ['json' => $parameters]),
            ),
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
    public function getWebshopUser(array $parameters = []): WebshopUser
    {
        return WebshopUser::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/Webshop/GetWebshopUser', ['json' => $parameters]),
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
    public function getWebshopUserAvailableBudget(array $parameters = []): float
    {
        return $this->buildResponse(
            $this->getClient()->post('/v3/Webshop/GetWebshopUserAvailableBudget', ['json' => $parameters]),
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
    public function getWebshopUserByLogin(array $parameters = []): WebshopUser
    {
        return WebshopUser::make(
            $this->buildResponse(
                $this->getClient()->post('/v3/Webshop/GetWebshopUserByLogin', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg een bestellijst o.b.v. webshopgebruikersnummer of debiteurnummer voor de producttypes zie eindpunt /Webshop/GetWebshopUserOrderlistProductTypes.
     *
     * @param array{
     *     SkipRecords?: int,
     *     TakeRecords?: int,
     *     WebshopUserProductListType?: int|null,
     *     DebtorId?: int|null,
     *     WebshopUserId?: int|null,
     * } $parameters
     *
     * @return array<array-key, WebshopOrderlistProduct>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserOrderlist(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => WebshopOrderlistProduct::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Webshop/GetWebshopUserOrderlist', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg de bestellijstproducttypes.
     *
     * @return array<array-key, WebshopUserProductType>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserOrderlistProductTypes(): array
    {
        return array_map(
            static fn (array $data) => WebshopUserProductType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Webshop/GetWebshopUserOrderlistProductTypes'),
            ),
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
     * @return array<array-key, WebshopUserProductOfProductV12>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserProductList(array $parameters = []): array
    {
        return array_map(
            static fn (array $data) => WebshopUserProductOfProductV12::make($data),
            $this->buildResponse(
                $this->getClient()->post('/v3/Webshop/GetWebshopUserProductList', ['json' => $parameters]),
            ),
        );
    }

    /**
     * Verkrijg de type WebshopUserProductlijsten.
     *
     * @return array<array-key, WebshopUserProductType>
     *
     * @throws Logic4ApiException
     */
    public function getWebshopUserProductListTypes(): array
    {
        return array_map(
            static fn (array $data) => WebshopUserProductType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Webshop/GetWebshopUserProductListTypes'),
            ),
        );
    }

    /**
     * Type webshopgebruikers.
     *
     * @return array<array-key, WebshopUserType>
     *
     * @throws Logic4ApiException
     */
    public function getWebShopUserTypes(): array
    {
        return array_map(
            static fn (array $data) => WebshopUserType::make($data),
            $this->buildResponse(
                $this->getClient()->get('/v3/Webshop/GetWebShopUserTypes'),
            ),
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
    public function updateQtyWebshopUserProduct(array $parameters = []): void
    {
        $this->getClient()->put('/v3/Webshop/UpdateQtyWebshopUserProduct', ['json' => $parameters]);
    }
}
