<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V20;

class ProductImageV2Logic4ResponseList
{
    /**
     * @param array<\Webparking\Logic4Client\Data\V20\ProductImageV2> $records
     * @param array<string>                                           $validationMessages
     */
    public function __construct(
        public array $records,
        public int $recordsCounter,
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            records: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V20\ProductImageV2::make($item), $data['Records'] ?? []),
            recordsCounter: $data['RecordsCounter'] ?? 0,
            validationMessages: $data['ValidationMessages'] ?? [],
        );
    }
}
