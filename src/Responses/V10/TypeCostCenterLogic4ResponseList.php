<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V10;

class TypeCostCenterLogic4ResponseList
{
    /**
     * @param array<\Webparking\Logic4Client\Data\V10\TypeCostCenter> $records
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
            records: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V10\TypeCostCenter::make($item), $data['Records'] ?? []),
            recordsCounter: $data['RecordsCounter'] ?? 0,
            validationMessages: $data['ValidationMessages'] ?? [],
        );
    }
}
