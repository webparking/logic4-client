<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class WebshopVisitorBehaviour
{
    public function __construct(
        public int $id,
        public ?Carbon $dateTimeAdded,
        public ?Carbon $dateTimeModified,
        public int $productId,
        public ?int $composedProductParentId,
        public ?float $qtyDec,
        public ?string $commission,
        public string $webshopUserProductListType,
        public ?int $debtorId,
        public ?int $websiteDomainId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            dateTimeAdded: isset($data['DateTimeAdded']) ? Carbon::parse($data['DateTimeAdded']) : null,
            dateTimeModified: isset($data['DateTimeModified']) ? Carbon::parse($data['DateTimeModified']) : null,
            productId: $data['ProductId'] ?? 0,
            composedProductParentId: $data['ComposedProductParentId'] ?? null,
            qtyDec: $data['QtyDec'] ?? null,
            commission: $data['Commission'] ?? null,
            webshopUserProductListType: $data['WebshopUserProductListType'] ?? '',
            debtorId: $data['DebtorId'] ?? null,
            websiteDomainId: $data['WebsiteDomainId'] ?? null,
        );
    }
}
