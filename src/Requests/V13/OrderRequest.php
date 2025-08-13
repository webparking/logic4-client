<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests\V13;

use Webparking\Logic4Client\Data\V13\Order;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\V13\Int32Logic4Response;

class OrderRequest extends Request
{
    /**
     * Wijzig of maak een nieuwe factuur aan, het is alleen mogelijk om stamgegevens van een factuur te updaten (status, NAW, betaal/verzendmethode).
     * Factuurregels kunnen slechts eenmalig bij het aanmaken van de factuur gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) factuurnummer in de response gevuld.
     *
     * @param array{
     *     Totals?: array{ShippingCost?: number, ShippingCostIncl?: number|null}|null,
     *     DebtorId?: integer|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: integer|null, TypeId?: integer|null, Value?: string|null}|null,
     *     Id?: integer|null,
     *     PaymentMethod?: array{Id?: integer, Description?: string|null, MaxAmount?: number|null, SelectKey?: string|null}|null,
     *     ShippingMethod?: array{Id?: integer, Name?: string|null, ExportCode?: string|null}|null,
     *     CheckForOrderCostAndPaymentRegulation?: boolean|null,
     *     OrderStatus?: array{Id?: integer, Value?: string|null}|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: boolean, UseSystemPricesForProductCompositionProducts?: boolean}, InclPrice?: number|null, GrossInclPrice?: number|null, Id?: integer|null, Description?: string|null, Description2?: string|null, ProductId?: integer|null, Qty?: number, BuyPrice?: number|null, GrossPrice?: number|null, NettPrice?: number|null, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string|null, ProductBarcode1?: string|null, VATPercentage?: number|null, Notes?: string|null, DebtorId?: integer, OrderId?: integer|null, WarehouseId?: integer|null, Commission?: string|null, DeliveryOptionId?: integer|null, VatCodeId?: integer|null, VatCodeIdOverrule?: integer|null, FreeValue1?: string|null, FreeValue2?: string|null, FreeValue3?: string|null, FreeValue4?: string|null, FreeValue5?: string|null, ExpectedNextDelivery?: string|null, ExternalValue?: array{TypeId?: integer, Value?: string|null}, AgreedDeliveryDate?: string|null, Type1Id?: integer|null, Type2Id?: integer|null, Type3Id?: integer|null, Type4Id?: integer|null, Type5Id?: integer|null}>|null,
     *     AcceptTermsAndConditions?: boolean|null,
     *     DeliveryAddress?: array{TelephoneNumber?: string|null, Email?: string|null, Street2?: string|null, HouseNumber2?: string|null, HouseNumberAddition2?: string|null, Id?: integer|null, ProvinceId?: integer|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null}|null,
     *     InvoiceAddress?: array{Id?: integer|null, ProvinceId?: integer|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null}|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: integer|null,
     *     UserId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DeliveryOptionId?: integer|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: integer, Freevalue1?: string|null, Freevalue2?: string|null, Freevalue3?: string|null, Freevalue4?: string|null, Freevalue5?: string|null}|null,
     *     Notes?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     FreeValue6?: string|null,
     *     FreeValue7?: string|null,
     *     FreeValue8?: string|null,
     *     OrderType1Id?: integer|null,
     *     OrderType2Id?: integer|null,
     *     OrderType3Id?: integer|null,
     *     OrderType4Id?: integer|null,
     *     OrderType5Id?: integer|null,
     *     OrderType6Id?: integer|null,
     *     OrderType7Id?: integer|null,
     *     OrderType8Id?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateInvoice(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.3/Orders/AddUpdateInvoice', ['json' => $parameters]),
            )
        );
    }

    /**
     * Wijzig of maak een nieuwe order aan, het is alleen mogelijk om stamgegevens van een order te updaten (status, NAW, betaal/verzendmethode).
     * Orderregels kunnen slechts eenmalig bij het aanmaken van de order gevuld worden.
     * Bij het succesvol aanmaken/updaten wordt het (nieuwe) ordernummer in de response gevuld.
     * Met v1.2 of hoger kan het Id van het afleveradres gebruikt worden om het afleveradres te bepalen.
     * Met v1.3 wordt emballage meegenomen met de order.
     *
     * @param array{
     *     Totals?: array{ShippingCost?: number, ShippingCostIncl?: number|null}|null,
     *     DebtorId?: integer|null,
     *     CustomerThirdPartyExternalIdentifer?: array{DebtorId?: integer|null, TypeId?: integer|null, Value?: string|null}|null,
     *     Id?: integer|null,
     *     PaymentMethod?: array{Id?: integer, Description?: string|null, MaxAmount?: number|null, SelectKey?: string|null}|null,
     *     ShippingMethod?: array{Id?: integer, Name?: string|null, ExportCode?: string|null}|null,
     *     CheckForOrderCostAndPaymentRegulation?: boolean|null,
     *     OrderStatus?: array{Id?: integer, Value?: string|null}|null,
     *     OrderRows?: array<array{OrderRowWithProductComposition?: array{AddProductCompositionByParentProductToOrder?: boolean, UseSystemPricesForProductCompositionProducts?: boolean}, InclPrice?: number|null, GrossInclPrice?: number|null, Id?: integer|null, Description?: string|null, Description2?: string|null, ProductId?: integer|null, Qty?: number, BuyPrice?: number|null, GrossPrice?: number|null, NettPrice?: number|null, QtyDeliverd?: number, QtyDeliverd_NotInvoiced?: number, ProductCode?: string|null, ProductBarcode1?: string|null, VATPercentage?: number|null, Notes?: string|null, DebtorId?: integer, OrderId?: integer|null, WarehouseId?: integer|null, Commission?: string|null, DeliveryOptionId?: integer|null, VatCodeId?: integer|null, VatCodeIdOverrule?: integer|null, FreeValue1?: string|null, FreeValue2?: string|null, FreeValue3?: string|null, FreeValue4?: string|null, FreeValue5?: string|null, ExpectedNextDelivery?: string|null, ExternalValue?: array{TypeId?: integer, Value?: string|null}, AgreedDeliveryDate?: string|null, Type1Id?: integer|null, Type2Id?: integer|null, Type3Id?: integer|null, Type4Id?: integer|null, Type5Id?: integer|null}>|null,
     *     AcceptTermsAndConditions?: boolean|null,
     *     DeliveryAddress?: array{TelephoneNumber?: string|null, Email?: string|null, Street2?: string|null, HouseNumber2?: string|null, HouseNumberAddition2?: string|null, Id?: integer|null, ProvinceId?: integer|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null}|null,
     *     InvoiceAddress?: array{Id?: integer|null, ProvinceId?: integer|null, ContactName?: string|null, CompanyName?: string|null, PostalCode?: string|null, City?: string|null, CountryCode?: string|null, Street?: string|null, HouseNumber?: string|null, HouseNumberAddition?: string|null}|null,
     *     CreationDate?: string|null,
     *     Description?: string|null,
     *     Reference?: string|null,
     *     BranchId?: integer|null,
     *     UserId?: integer|null,
     *     WebsiteDomainId?: integer|null,
     *     DeliveryOptionId?: integer|null,
     *     DeliveryDate?: string|null,
     *     OrderShipmentFreeValues?: array{ShipperTypeId?: integer, Freevalue1?: string|null, Freevalue2?: string|null, Freevalue3?: string|null, Freevalue4?: string|null, Freevalue5?: string|null}|null,
     *     Notes?: string|null,
     *     FreeValue1?: string|null,
     *     FreeValue2?: string|null,
     *     FreeValue3?: string|null,
     *     FreeValue4?: string|null,
     *     FreeValue5?: string|null,
     *     FreeValue6?: string|null,
     *     FreeValue7?: string|null,
     *     FreeValue8?: string|null,
     *     OrderType1Id?: integer|null,
     *     OrderType2Id?: integer|null,
     *     OrderType3Id?: integer|null,
     *     OrderType4Id?: integer|null,
     *     OrderType5Id?: integer|null,
     *     OrderType6Id?: integer|null,
     *     OrderType7Id?: integer|null,
     *     OrderType8Id?: integer|null,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateOrder(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1.3/Orders/AddUpdateOrder', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg orders o.b.v. het meegestuurde filter.
     * Vanaf 1.3 worden velden met de waarde null niet teruggegeven.
     *
     * @param array{
     *     SkipRecords?: integer|null,
     *     TakeRecords?: integer|null,
     *     ChangedAfter?: string|null,
     *     Id?: integer|null,
     *     DebtorId?: integer|null,
     *     CreationDateFrom?: string|null,
     *     CreationDateTo?: string|null,
     *     Barcode1?: string|null,
     *     ProductCode?: string|null,
     *     Delivery_Address?: string|null,
     *     Delivery_PostalCode?: string|null,
     *     Delivery_City?: string|null,
     *     Delivery_ContactName?: string|null,
     *     Delivery_CompanyName?: string|null,
     *     Delivery_Email?: string|null,
     *     Invoice_Address?: string|null,
     *     Invoice_PostalCode?: string|null,
     *     Invoice_City?: string|null,
     *     Invoice_ContactName?: string|null,
     *     Invoice_CompanyName?: string|null,
     *     Invoice_Email?: string|null,
     *     LastActionFrom?: string|null,
     *     LastActionTo?: string|null,
     *     Reference?: string|null,
     *     LoadPayments?: boolean|null,
     *     StatusId?: integer|null,
     *     Type1Id?: integer|null,
     *     Type2Id?: integer|null,
     *     Type3Id?: integer|null,
     *     WebsiteDomainIds?: array<integer>|null,
     * } $parameters
     *
     * @return \Generator<array-key, Order>
     *
     * @throws Logic4ApiException
     */
    public function getOrders(array $parameters = []): \Generator
    {
        $iterator = $this->paginateRecords('/v1.3/Orders/GetOrders', $parameters);

        foreach ($iterator as $record) {
            yield Order::make($record);
        }
    }
}
