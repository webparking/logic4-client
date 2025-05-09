<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ProductV11WebshopUserProduct
{
    public function __construct(
        public int $id,
        public ?\Carbon\Carbon $dateTimeAdded,
        public ?int $composedProductParentId,
        public ?int $webshopUserId,
        public ?ProductV11 $productInformation,
        public int $productId,
        public ?float $qtyDec,
        public ?string $commission,
        public bool $excludedFromAnnualBudget,
        public int $typeId,
        public ?int $debtorId,
        public ?string $visitorCode,
        public ?int $websiteDomainId,
        public ?string $shoppingCartKey,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            dateTimeAdded: isset($data['DateTimeAdded']) ? \Carbon\Carbon::parse($data['DateTimeAdded']) : null,
            composedProductParentId: $data['ComposedProductParentId'] ?? null,
            webshopUserId: $data['WebshopUserId'] ?? null,
            productInformation: isset($data['ProductInformation']) ? ProductV11::make($data['ProductInformation']) : null,
            productId: $data['ProductId'] ?? 0,
            qtyDec: $data['QtyDec'] ?? null,
            commission: $data['Commission'] ?? null,
            excludedFromAnnualBudget: $data['ExcludedFromAnnualBudget'] ?? false,
            typeId: $data['TypeId'] ?? 0,
            debtorId: $data['DebtorId'] ?? null,
            visitorCode: $data['VisitorCode'] ?? null,
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
            shoppingCartKey: $data['ShoppingCartKey'] ?? null,
        );
    }
}
