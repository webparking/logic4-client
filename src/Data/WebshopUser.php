<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class WebshopUser
{
    /** @param array<integer> $debtorWebshopUserProductExcludedFromAnnualBudgets */
    public function __construct(
        public bool $displayPricesWithoutPricelistCalculations,
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
            displayPricesWithoutPricelistCalculations: $data['DisplayPricesWithoutPricelistCalculations'] ?? false,
            webshopUserId: $data['WebshopUserId'] ?? null,
            debtorId: $data['DebtorId'] ?? 0,
            limitedToOrderlist: $data['LimitedToOrderlist'] ?? false,
            canOrderOutsideOrderListWithApproval: $data['CanOrderOutsideOrderListWithApproval'] ?? false,
            canModifyOrderList: $data['CanModifyOrderList'] ?? false,
            supervisorId1: $data['SupervisorId1'] ?? null,
            supervisorId2: $data['SupervisorId2'] ?? null,
            hideProductPrices: $data['HideProductPrices'] ?? false,
            showOrdersRightLevel: $data['ShowOrdersRightLevel'] ?? 0,
            showInvoicesRightLevel: $data['ShowInvoicesRightLevel'] ?? 0,
            annualBudget: $data['AnnualBudget'] ?? null,
            maxOrderAmountWithoutApproval: $data['MaxOrderAmountWithoutApproval'] ?? null,
            webShopUserTypeId: $data['WebShopUserTypeId'] ?? 0,
            username: $data['Username'] ?? null,
            email: $data['Email'] ?? null,
            telephoneNumber: $data['TelephoneNumber'] ?? null,
            city: $data['City'] ?? null,
            postalCode: $data['PostalCode'] ?? null,
            address: $data['Address'] ?? null,
            deliveryAddressId: $data['DeliveryAddressId'] ?? null,
            minOrderAmount: $data['MinOrderAmount'] ?? null,
            countryId: $data['CountryId'] ?? 0,
            companyName: $data['CompanyName'] ?? null,
            name: $data['Name'] ?? null,
            globalisationId: $data['GlobalisationId'] ?? 0,
            webshopAssortment: $data['WebshopAssortment'] ?? false,
            debtorCostCenterId: $data['Debtor_CostCenterId'] ?? null,
            canParkOrders: $data['CanParkOrders'] ?? false,
            passwordLastchanged: isset($data['Password_Lastchanged']) ? Carbon::parse($data['Password_Lastchanged']) : null,
            navigateWebshopUserToProductlistAfterLogin: $data['NavigateWebshopUser_ToProductlistAfterLogin'] ?? false,
            navigateWebshopUserToAssortmentAfterLogin: $data['NavigateWebshopUser_ToAssortmentAfterLogin'] ?? false,
            canUseCustomDeliveryAddress: $data['CanUseCustomDeliveryAddress'] ?? false,
            isParticulier: $data['IsParticulier'] ?? false,
            relationTypeId: $data['RelationTypeId'] ?? 0,
            canUseCustomInvoiceAddress: $data['CanUseCustomInvoiceAddress'] ?? false,
            invoiceAddressId: $data['InvoiceAddressId'] ?? null,
            limitedToAssortment: $data['LimitedToAssortment'] ?? false,
            isExternalBuyer: $data['IsExternalBuyer'] ?? false,
            hideFromPrices: $data['HideFromPrices'] ?? false,
            relationGroupId: $data['RelationGroupId'] ?? null,
            offerModePriceMargin: $data['OfferModePriceMargin'] ?? null,
            offerModeUseLocations: $data['OfferModeUseLocations'] ?? false,
            offerModeExportConfigurationJson: $data['OfferModeExportConfigurationJson'] ?? null,
            debtorWebshopUserProductExcludedFromAnnualBudgets: $data['Debtor_WebshopUser_ProductExcludedFromAnnualBudgets'] ?? null,
        );
    }
}
