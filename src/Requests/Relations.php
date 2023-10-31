<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Requests;

use Webparking\Logic4Client\Data\Creditor;
use Webparking\Logic4Client\Data\CreditorDiscount;
use Webparking\Logic4Client\Data\Customer;
use Webparking\Logic4Client\Data\CustomerAddress;
use Webparking\Logic4Client\Data\CustomerContact;
use Webparking\Logic4Client\Data\Representative;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\PaginatedResponse;
use Webparking\Logic4Client\Request;
use Webparking\Logic4Client\Responses\AddressTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\BooleanLogic4Response;
use Webparking\Logic4Client\Responses\CreditorDiscountTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\CreditorThirdPartyExternalIdentiferLogic4ResponseList;
use Webparking\Logic4Client\Responses\CustomerThirdPartyExternalIdentiferLogic4ResponseList;
use Webparking\Logic4Client\Responses\GenderLogic4ResponseList;
use Webparking\Logic4Client\Responses\Int32Logic4Response;
use Webparking\Logic4Client\Responses\RelationStatusLogic4ResponseList;
use Webparking\Logic4Client\Responses\RelationTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\SecondTypeContactGroupLogic4ResponseList;
use Webparking\Logic4Client\Responses\ThirdPartyExternalIdentifierTypeLogic4ResponseList;
use Webparking\Logic4Client\Responses\TypeContactGroupLogic4ResponseList;

class Relations extends Request
{
    /**
     * Crediteur discount toevoegen. Retourneert de Id.
     *
     * @param array{
     *     TypeId?: integer,
     *     CreditorId?: integer,
     *     BrandId?: integer,
     *     DateFrom?: string,
     *     DateTo?: string,
     *     Percentage?: number,
     *     Amount?: number,
     *     Remarks?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addCreditorDiscount(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddCreditorDiscount', ['json' => $parameters]),
            )
        );
    }

    /**
     * Debiteur toevoegen.
     *
     * @param array{
     *     Id?: integer,
     *     IsoCode?: string,
     *     CountryCode?: string,
     *     CountryId?: integer,
     *     CompanyName?: string,
     *     FirstName?: string,
     *     LastName?: string,
     *     EmailAddress?: string,
     *     PaymentMethodId?: integer,
     *     PricelistIds?: array<integer>,
     *     TelephoneNumber?: string,
     *     MobileNumber?: string,
     *     Faxnumber?: string,
     *     ChamberOfCommerceCode?: string,
     *     Website?: string,
     *     Discount?: number,
     *     StandardReportIdForPickingList?: integer,
     *     StandardReportIdForSalesOrderDelivery?: integer,
     *     City?: string,
     *     Zipcode?: string,
     *     Street?: string,
     *     HouseNumber?: string,
     *     HouseNumberAddition?: string,
     *     VatNumber?: string,
     *     DontPrintPaperInvoiceForDebtor?: boolean,
     *     ReceiveInvoiceElectronically?: boolean,
     *     ElectronicInvoiceAttachmentType?: integer,
     *     StandardInvoiceLayoutReportId?: integer,
     *     Preposition?: string,
     *     CreditLimit?: number,
     *     ShippingMethodId?: integer,
     *     GlobalisationId?: integer,
     *     VatCodeId?: integer,
     *     StatusId?: integer,
     *     RepresentativeId?: integer,
     *     RelationTypeId?: integer,
     *     GenderId?: integer,
     *     StandardPackagingSlipLayoutReportId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addCustomer(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddCustomer', ['json' => $parameters]),
            )
        );
    }

    /**
     * Adres toevoegen of updaten.
     *
     * @param array{
     *     Email?: string,
     *     ContactName?: string,
     *     CompanyName?: string,
     *     Address1?: string,
     *     Address2?: string,
     *     Id?: integer,
     *     DebtorId?: integer,
     *     CreditorId?: integer,
     *     IsMainContact?: boolean,
     *     IsHidden?: boolean,
     *     OwnContactNumber?: string,
     *     CountryCode?: string,
     *     IsoCode?: string,
     *     City?: string,
     *     Zipcode?: string,
     *     Street?: string,
     *     HouseNumber?: string,
     *     HouseNumberAddition?: string,
     *     TelephoneNumber?: string,
     *     CountryId?: integer,
     *     ZoneId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateAddress(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateAddress', ['json' => $parameters]),
            )
        );
    }

    /**
     * Contactpersoon toevoegen of updaten.
     *
     * @param array{
     *     EmailAddress?: string,
     *     FirstName?: string,
     *     Function?: string,
     *     Initials?: string,
     *     InsertionName?: string,
     *     LastName?: string,
     *     MobileNumber?: string,
     *     CreatedDateTime?: string,
     *     ChangedDateTime?: string,
     *     Id?: integer,
     *     DebtorId?: integer,
     *     CreditorId?: integer,
     *     IsMainContact?: boolean,
     *     IsHidden?: boolean,
     *     OwnContactNumber?: string,
     *     CountryCode?: string,
     *     IsoCode?: string,
     *     City?: string,
     *     Zipcode?: string,
     *     Street?: string,
     *     HouseNumber?: string,
     *     HouseNumberAddition?: string,
     *     TelephoneNumber?: string,
     *     CountryId?: integer,
     *     ZoneId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateContact(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateContact', ['json' => $parameters]),
            )
        );
    }

    /**
     * Crediteur externe identifier toevoegen of updaten.
     *
     * @param array{
     *     CreditorId?: integer,
     *     TypeId?: integer,
     *     Value?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateCreditorThirdPartyExternalIdentifier(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateCreditorThirdPartyExternalIdentifier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Debiteur toevoegen of updaten.
     *
     * @param array{
     *     Id?: integer,
     *     IsoCode?: string,
     *     CountryCode?: string,
     *     CountryId?: integer,
     *     CompanyName?: string,
     *     FirstName?: string,
     *     LastName?: string,
     *     EmailAddress?: string,
     *     PaymentMethodId?: integer,
     *     PricelistIds?: array<integer>,
     *     TelephoneNumber?: string,
     *     MobileNumber?: string,
     *     Faxnumber?: string,
     *     ChamberOfCommerceCode?: string,
     *     Website?: string,
     *     Discount?: number,
     *     StandardReportIdForPickingList?: integer,
     *     StandardReportIdForSalesOrderDelivery?: integer,
     *     City?: string,
     *     Zipcode?: string,
     *     Street?: string,
     *     HouseNumber?: string,
     *     HouseNumberAddition?: string,
     *     VatNumber?: string,
     *     DontPrintPaperInvoiceForDebtor?: boolean,
     *     ReceiveInvoiceElectronically?: boolean,
     *     ElectronicInvoiceAttachmentType?: integer,
     *     StandardInvoiceLayoutReportId?: integer,
     *     Preposition?: string,
     *     CreditLimit?: number,
     *     ShippingMethodId?: integer,
     *     GlobalisationId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     *
     * @deprecated Let op! Functie is verouderd. Implementeer een alternatief. - Debiteur toevoegen of updaten.
     * Gebruik als alternatief de gesplitste functies UpdateCustomer en AddCustomer.
     */
    public function addUpdateCustomer(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateCustomer', ['json' => $parameters]),
            )
        );
    }

    /**
     * Debiteur externe identifier toevoegen of updaten.
     *
     * @param array{
     *     DebtorId?: integer,
     *     TypeId?: integer,
     *     Value?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function addUpdateCustomerThirdPartyExternalIdentifier(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/AddUpdateCustomerThirdPartyExternalIdentifier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een crediteur derde partij externe identifier.
     *
     * @param array{
     *     CreditorId?: integer,
     *     TypeId?: integer,
     *     Value?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteCreditorThirdPartyExternalIdentifier(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/DeleteCreditorThirdPartyExternalIdentifier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verwijder een debiteur derde partij externe identifier.
     *
     * @param array{
     *     DebtorId?: integer,
     *     TypeId?: integer,
     *     Value?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function deleteCustomerThirdPartyExternalIdentifier(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/DeleteCustomerThirdPartyExternalIdentifier', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg adressen o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     ChangedAfter?: string,
     *     Id?: integer,
     *     AddressTypeId?: integer,
     *     PhoneNumber?: string,
     *     DebtorId?: integer,
     *     CreditorId?: integer,
     *     ExcludeHiddenContacts?: boolean,
     *     OwnContactNumber?: string,
     * } $parameters
     *
     * @return PaginatedResponse<CustomerAddress>
     *
     * @throws Logic4ApiException
     */
    public function getAddresses(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Relations/GetAddresses', $parameters),
            CustomerAddress::class,
        );
    }

    /**
     * Verkrijg alle adrestypes.
     *
     * @throws Logic4ApiException
     */
    public function getAddressTypes(): AddressTypeLogic4ResponseList
    {
        return AddressTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetAddressTypes'),
            )
        );
    }

    /**
     * Verkrijg contacten o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     ChangedAfter?: string,
     *     Id?: integer,
     *     AddressTypeId?: integer,
     *     PhoneNumber?: string,
     *     DebtorId?: integer,
     *     CreditorId?: integer,
     *     ExcludeHiddenContacts?: boolean,
     *     OwnContactNumber?: string,
     * } $parameters
     *
     * @return PaginatedResponse<CustomerContact>
     *
     * @throws Logic4ApiException
     */
    public function getContacts(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Relations/GetContacts', $parameters),
            CustomerContact::class,
        );
    }

    /**
     * Crediteur discounts ophalen (maximaal 1000).
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     Ids?: array<integer>,
     * } $parameters
     *
     * @return PaginatedResponse<CreditorDiscount>
     *
     * @throws Logic4ApiException
     */
    public function getCreditorDiscounts(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1/Relations/GetCreditorDiscounts', $parameters),
            CreditorDiscount::class,
        );
    }

    /**
     * Crediteur discount types ophalen.
     *
     * @throws Logic4ApiException
     */
    public function getCreditorDiscountTypes(): CreditorDiscountTypeLogic4ResponseList
    {
        return CreditorDiscountTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetCreditorDiscountTypes'),
            )
        );
    }

    /**
     * Verkrijg crediteuren o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     ChangedAfter?: string,
     *     Id?: integer,
     *     PhoneNumber?: string,
     *     WebsiteDomainId?: integer,
     *     EmailAddress?: string,
     *     EmailAddressIsExact?: boolean,
     * } $parameters
     *
     * @return PaginatedResponse<Creditor>
     *
     * @throws Logic4ApiException
     */
    public function getCreditors(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Relations/GetCreditors', $parameters),
            Creditor::class,
        );
    }

    /**
     * Verkrijg crediteur externe identifiers o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     CreditorId?: integer,
     *     TypeId?: integer,
     *     Value?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getCreditorThirdPartyExternalIdentifiers(
        array $parameters = [],
    ): CreditorThirdPartyExternalIdentiferLogic4ResponseList {
        return CreditorThirdPartyExternalIdentiferLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/GetCreditorThirdPartyExternalIdentifiers', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg debiteuren o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     *     ChangedAfter?: string,
     *     Id?: integer,
     *     PhoneNumber?: string,
     *     WebsiteDomainId?: integer,
     *     EmailAddress?: string,
     *     EmailAddressIsExact?: boolean,
     * } $parameters
     *
     * @return PaginatedResponse<Customer>
     *
     * @throws Logic4ApiException
     */
    public function getCustomers(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Relations/GetCustomers', $parameters),
            Customer::class,
        );
    }

    /**
     * Verkrijg debiteur externe identifiers o.b.v. het meegestuurde filter.
     *
     * @param array{
     *     DebtorId?: integer,
     *     TypeId?: integer,
     *     Value?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function getCustomerThirdPartyExternalIdentifiers(
        array $parameters = [],
    ): CustomerThirdPartyExternalIdentiferLogic4ResponseList {
        return CustomerThirdPartyExternalIdentiferLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/GetCustomerThirdPartyExternalIdentifiers', ['json' => $parameters]),
            )
        );
    }

    /**
     * Verkrijg alle geslachttypes.
     *
     * @throws Logic4ApiException
     */
    public function getGenders(): GenderLogic4ResponseList
    {
        return GenderLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetGenders'),
            )
        );
    }

    /**
     * Verkrijg alle relatiestatussen.
     *
     * @throws Logic4ApiException
     */
    public function getRelationStatuses(): RelationStatusLogic4ResponseList
    {
        return RelationStatusLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetRelationStatuses'),
            )
        );
    }

    /**
     * Verkrijg alle relatietypes.
     *
     * @throws Logic4ApiException
     */
    public function getRelationTypes(): RelationTypeLogic4ResponseList
    {
        return RelationTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetRelationTypes'),
            )
        );
    }

    /**
     * Verkrijg alle vertegenwoordigers.
     *
     * @param array{
     *     SkipRecords?: integer,
     *     TakeRecords?: integer,
     * } $parameters
     *
     * @return PaginatedResponse<Representative>
     *
     * @throws Logic4ApiException
     */
    public function getRepresentatives(array $parameters = []): PaginatedResponse
    {
        return new PaginatedResponse(
            $this->paginateRecords('/v1.1/Relations/GetRepresentatives', $parameters),
            Representative::class,
        );
    }

    /**
     * Verkrijg alle typen tweede relatiecontacten.
     *
     * @throws Logic4ApiException
     */
    public function getSecondContactGroupTypes(
    ): SecondTypeContactGroupLogic4ResponseList {
        return SecondTypeContactGroupLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetSecondContactGroupTypes'),
            )
        );
    }

    /**
     * Verkrijg alle externe identifiertypes.
     *
     * @throws Logic4ApiException
     */
    public function getThirdPartyExternalIdentfierTypes(
    ): ThirdPartyExternalIdentifierTypeLogic4ResponseList {
        return ThirdPartyExternalIdentifierTypeLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetThirdPartyExternalIdentfierTypes'),
            )
        );
    }

    /**
     * Verkrijg alle relatiegroepen.
     *
     * @throws Logic4ApiException
     */
    public function getTypeContactGroups(): TypeContactGroupLogic4ResponseList
    {
        return TypeContactGroupLogic4ResponseList::make(
            $this->buildResponse(
                $this->getClient()->get('/v1/Relations/GetTypeContactGroups'),
            )
        );
    }

    /**
     * Crediteur discount updaten. Retourneert true indien succesvol.
     *
     * @param array{
     *     Id?: integer,
     *     TypeId?: integer,
     *     CreditorId?: integer,
     *     BrandId?: integer,
     *     DateFrom?: string,
     *     DateTo?: string,
     *     Percentage?: number,
     *     Amount?: number,
     *     Remarks?: string,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateCreditorDiscount(
        array $parameters = [],
    ): BooleanLogic4Response {
        return BooleanLogic4Response::make(
            $this->buildResponse(
                $this->getClient()->post('/v1/Relations/UpdateCreditorDiscount', ['json' => $parameters]),
            )
        );
    }

    /**
     * Waarden van een bestaande debiteur updaten.
     *
     * @param array{
     *     Id?: integer,
     *     IsoCode?: string,
     *     CountryCode?: string,
     *     CountryId?: integer,
     *     CompanyName?: string,
     *     FirstName?: string,
     *     LastName?: string,
     *     EmailAddress?: string,
     *     PaymentMethodId?: integer,
     *     PricelistIds?: array<integer>,
     *     TelephoneNumber?: string,
     *     MobileNumber?: string,
     *     Faxnumber?: string,
     *     ChamberOfCommerceCode?: string,
     *     Website?: string,
     *     Discount?: number,
     *     StandardReportIdForPickingList?: integer,
     *     StandardReportIdForSalesOrderDelivery?: integer,
     *     City?: string,
     *     Zipcode?: string,
     *     Street?: string,
     *     HouseNumber?: string,
     *     HouseNumberAddition?: string,
     *     VatNumber?: string,
     *     DontPrintPaperInvoiceForDebtor?: boolean,
     *     ReceiveInvoiceElectronically?: boolean,
     *     ElectronicInvoiceAttachmentType?: integer,
     *     StandardInvoiceLayoutReportId?: integer,
     *     Preposition?: string,
     *     CreditLimit?: number,
     *     ShippingMethodId?: integer,
     *     GlobalisationId?: integer,
     *     VatCodeId?: integer,
     *     StatusId?: integer,
     *     RepresentativeId?: integer,
     *     RelationTypeId?: integer,
     *     GenderId?: integer,
     *     StandardPackagingSlipLayoutReportId?: integer,
     * } $parameters
     *
     * @throws Logic4ApiException
     */
    public function updateCustomer(array $parameters = []): Int32Logic4Response
    {
        return Int32Logic4Response::make(
            $this->buildResponse(
                $this->getClient()->patch('/v1/Relations/UpdateCustomer', ['json' => $parameters]),
            )
        );
    }
}
