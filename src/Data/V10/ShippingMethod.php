<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ShippingMethod
{
    /**
     * @param array<string>                                          $countryIsoCodes
     * @param array<\Webparking\Logic4Client\Data\V10\WebsiteDomain> $websiteDomains
     */
    public function __construct(
        public int $id,
        public ?string $name,
        public ?string $description,
        public float $shipmentCosts,
        public ?string $deliveryTime,
        public bool $tracing,
        public ?string $selectkeyCms,
        public ?array $countryIsoCodes,
        public float $basicAmount,
        public ?float $freeShippingAboveAmount,
        public ?float $freeShippingAboveAmountInclusive,
        public ?array $websiteDomains,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            description: $data['Description'] ?? null,
            shipmentCosts: $data['ShipmentCosts'] ?? 0.0,
            deliveryTime: $data['DeliveryTime'] ?? null,
            tracing: $data['Tracing'] ?? false,
            selectkeyCms: $data['SelectkeyCms'] ?? null,
            countryIsoCodes: $data['CountryIsoCodes'] ?? null,
            basicAmount: $data['BasicAmount'] ?? 0.0,
            freeShippingAboveAmount: $data['FreeShippingAboveAmount'] ?? null,
            freeShippingAboveAmountInclusive: $data['FreeShippingAboveAmountInclusive'] ?? null,
            websiteDomains: array_map(static fn (array $item) => WebsiteDomain::make($item), $data['WebsiteDomains'] ?? []),
        );
    }
}
