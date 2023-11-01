<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class WebshopUserProduct
{
    public function __construct(
        public int $id,
        public ?Carbon $dateTimeAdded,
        public int $productId,
        public ?float $qtyDec,
        public ?string $commission,
        public bool $excludedFromAnnualBudget,
        public ?int $composedProductParentId,
        public int $typeId,
        public ?int $webshopUserId,
        public ?int $debtorId,
        public ?Product $productInformation,
        public ?string $visitorCode,
        public ?int $websiteDomainId,
        public ?string $shoppingCartKey,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            dateTimeAdded: $data['DateTimeAdded'] ? Carbon::parse($data['DateTimeAdded']) : null,
            productId: $data['ProductId'],
            qtyDec: $data['QtyDec'],
            commission: $data['Commission'],
            excludedFromAnnualBudget: $data['ExcludedFromAnnualBudget'],
            composedProductParentId: $data['ComposedProductParentId'],
            typeId: $data['TypeId'],
            webshopUserId: $data['WebshopUserId'],
            debtorId: $data['DebtorId'],
            productInformation: $data['ProductInformation'] ? Product::make($data['ProductInformation']) : null,
            visitorCode: $data['VisitorCode'],
            websiteDomainId: $data['WebsiteDomainId'],
            shoppingCartKey: $data['ShoppingCartKey'],
        );
    }
}
