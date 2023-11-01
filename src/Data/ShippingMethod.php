<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ShippingMethod
{
    /**
     * @param array<string>        $countryIsoCodes
     * @param array<WebsiteDomain> $websiteDomains
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
            id: $data['Id'],
            name: $data['Name'],
            description: $data['Description'],
            shipmentCosts: $data['ShipmentCosts'],
            deliveryTime: $data['DeliveryTime'],
            tracing: $data['Tracing'],
            selectkeyCms: $data['SelectkeyCms'],
            countryIsoCodes: $data['CountryIsoCodes'],
            basicAmount: $data['BasicAmount'],
            freeShippingAboveAmount: $data['FreeShippingAboveAmount'],
            freeShippingAboveAmountInclusive: $data['FreeShippingAboveAmountInclusive'],
            websiteDomains: array_map(static fn (array $item) => WebsiteDomain::make($item), $data['WebsiteDomains'] ?? []),
        );
    }
}
