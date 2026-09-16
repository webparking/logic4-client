<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V20;

class ProductDimensions
{
    public function __construct(
        public int $productId,
        public ?string $productCode,
        public ?int $piecesOnPallet,
        public ?int $PCSinInsidePackage,
        public ?int $PCSinOutsidePackage,
        public float $weightSingleProduct,
        public float $weightInsidePackage,
        public float $weightOutsidePackage,
        public float $volumeSingleProduct,
        public float $volumeInsidePackage,
        public float $volumeOutsidePackage,
        public float $widthSingleProduct,
        public float $widthInsidePackage,
        public float $widthOutsidePackage,
        public float $heightSingleProduct,
        public float $heightInsidePackage,
        public float $heightOutsidePackage,
        public float $depthSingleProduct,
        public float $depthInsidePackage,
        public float $depthOutsidePackage,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            productId: $data['ProductId'] ?? 0,
            productCode: $data['ProductCode'] ?? null,
            piecesOnPallet: $data['PiecesOnPallet'] ?? null,
            PCSinInsidePackage: $data['PCSinInsidePackage'] ?? null,
            PCSinOutsidePackage: $data['PCSinOutsidePackage'] ?? null,
            weightSingleProduct: $data['WeightSingleProduct'] ?? 0.0,
            weightInsidePackage: $data['WeightInsidePackage'] ?? 0.0,
            weightOutsidePackage: $data['WeightOutsidePackage'] ?? 0.0,
            volumeSingleProduct: $data['VolumeSingleProduct'] ?? 0.0,
            volumeInsidePackage: $data['VolumeInsidePackage'] ?? 0.0,
            volumeOutsidePackage: $data['VolumeOutsidePackage'] ?? 0.0,
            widthSingleProduct: $data['WidthSingleProduct'] ?? 0.0,
            widthInsidePackage: $data['WidthInsidePackage'] ?? 0.0,
            widthOutsidePackage: $data['WidthOutsidePackage'] ?? 0.0,
            heightSingleProduct: $data['HeightSingleProduct'] ?? 0.0,
            heightInsidePackage: $data['HeightInsidePackage'] ?? 0.0,
            heightOutsidePackage: $data['HeightOutsidePackage'] ?? 0.0,
            depthSingleProduct: $data['DepthSingleProduct'] ?? 0.0,
            depthInsidePackage: $data['DepthInsidePackage'] ?? 0.0,
            depthOutsidePackage: $data['DepthOutsidePackage'] ?? 0.0,
        );
    }
}
