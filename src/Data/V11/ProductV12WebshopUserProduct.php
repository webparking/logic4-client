<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ProductV12WebshopUserProduct
{
    public function __construct(
        public int $id,
        public ?\Carbon\Carbon $dateTimeAdded,
        public int $productId,
        public ?float $qtyDec,
        public ?string $commission,
        public bool $excludedFromAnnualBudget,
        public ?int $composedProductParentId,
        public int $typeId,
        public ?int $webshopUserId,
        public ?int $debtorId,
        public ?ProductV12 $productInformation,
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
            productId: $data['ProductId'] ?? 0,
            qtyDec: $data['QtyDec'] ?? null,
            commission: $data['Commission'] ?? null,
            excludedFromAnnualBudget: $data['ExcludedFromAnnualBudget'] ?? false,
            composedProductParentId: $data['ComposedProductParentId'] ?? null,
            typeId: $data['TypeId'] ?? 0,
            webshopUserId: $data['WebshopUserId'] ?? null,
            debtorId: $data['DebtorId'] ?? null,
            productInformation: isset($data['ProductInformation']) ? ProductV12::make($data['ProductInformation']) : null,
            visitorCode: $data['VisitorCode'] ?? null,
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
            shoppingCartKey: $data['ShoppingCartKey'] ?? null,
        );
    }
}
