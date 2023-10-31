<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class WebshopUser
{
    /** @param array<integer> $debtorWebshopUserProductExcludedFromAnnualBudgets */
    public function __construct(
        public bool $dislplayPricesWithoutPricelistCalculations,
        public ?int $webshopUserId,
        public int $debtorId,
        public bool $limitedToOrderlist,
        public bool $canOrderOutsideOrderListWithApproval,
        public bool $canModifyOrderList,
        public ?int $supervisorId1,
        public ?int $supervisorId2,
        public bool $hideProductPrices,
        public int $showOrdersRightLevel,
        public int $showInvoicesRightLevel,
        public ?float $annualBudget,
        public ?float $maxOrderAmountWithoutApproval,
        public int $webShopUserTypeId,
        public ?string $username,
        public ?string $email,
        public ?string $telephoneNumber,
        public ?string $city,
        public ?string $postalCode,
        public ?string $address,
        public ?int $deliveryAddressId,
        public ?float $minOrderAmount,
        public int $countryId,
        public ?string $companyName,
        public ?string $name,
        public int $globalisationId,
        public bool $webshopAssortment,
        public ?int $debtorCostCenterId,
        public bool $canParkOrders,
        public ?Carbon $passwordLastchanged,
        public bool $navigateWebshopUserToProductlistAfterLogin,
        public bool $navigateWebshopUserToAssortmentAfterLogin,
        public bool $canUseCustomDeliveryAddress,
        public bool $isParticulier,
        public int $relationTypeId,
        public bool $canUseCustomInvoiceAddress,
        public ?int $invoiceAddressId,
        public bool $limitedToAssortment,
        public bool $isExternalBuyer,
        public bool $hideFromPrices,
        public ?int $relationGroupId,
        public ?float $offerModePriceMargin,
        public bool $offerModeUseLocations,
        public ?string $offerModeExportConfigurationJson,
        public ?array $debtorWebshopUserProductExcludedFromAnnualBudgets,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            dislplayPricesWithoutPricelistCalculations: $data['DislplayPricesWithoutPricelistCalculations'],
            webshopUserId: $data['WebshopUserId'],
            debtorId: $data['DebtorId'],
            limitedToOrderlist: $data['LimitedToOrderlist'],
            canOrderOutsideOrderListWithApproval: $data['CanOrderOutsideOrderListWithApproval'],
            canModifyOrderList: $data['CanModifyOrderList'],
            supervisorId1: $data['SupervisorId1'],
            supervisorId2: $data['SupervisorId2'],
            hideProductPrices: $data['HideProductPrices'],
            showOrdersRightLevel: $data['ShowOrdersRightLevel'],
            showInvoicesRightLevel: $data['ShowInvoicesRightLevel'],
            annualBudget: $data['AnnualBudget'],
            maxOrderAmountWithoutApproval: $data['MaxOrderAmountWithoutApproval'],
            webShopUserTypeId: $data['WebShopUserTypeId'],
            username: $data['Username'],
            email: $data['Email'],
            telephoneNumber: $data['TelephoneNumber'],
            city: $data['City'],
            postalCode: $data['PostalCode'],
            address: $data['Address'],
            deliveryAddressId: $data['DeliveryAddressId'],
            minOrderAmount: $data['MinOrderAmount'],
            countryId: $data['CountryId'],
            companyName: $data['CompanyName'],
            name: $data['Name'],
            globalisationId: $data['GlobalisationId'],
            webshopAssortment: $data['WebshopAssortment'],
            debtorCostCenterId: $data['Debtor_CostCenterId'],
            canParkOrders: $data['CanParkOrders'],
            passwordLastchanged: $data['Password_Lastchanged'] ? Carbon::parse($data['Password_Lastchanged']) : null,
            navigateWebshopUserToProductlistAfterLogin: $data['NavigateWebshopUser_ToProductlistAfterLogin'],
            navigateWebshopUserToAssortmentAfterLogin: $data['NavigateWebshopUser_ToAssortmentAfterLogin'],
            canUseCustomDeliveryAddress: $data['CanUseCustomDeliveryAddress'],
            isParticulier: $data['IsParticulier'],
            relationTypeId: $data['RelationTypeId'],
            canUseCustomInvoiceAddress: $data['CanUseCustomInvoiceAddress'],
            invoiceAddressId: $data['InvoiceAddressId'],
            limitedToAssortment: $data['LimitedToAssortment'],
            isExternalBuyer: $data['IsExternalBuyer'],
            hideFromPrices: $data['HideFromPrices'],
            relationGroupId: $data['RelationGroupId'],
            offerModePriceMargin: $data['OfferModePriceMargin'],
            offerModeUseLocations: $data['OfferModeUseLocations'],
            offerModeExportConfigurationJson: $data['OfferModeExportConfigurationJson'],
            debtorWebshopUserProductExcludedFromAnnualBudgets: $data['Debtor_WebshopUser_ProductExcludedFromAnnualBudgets'],
        );
    }
}
