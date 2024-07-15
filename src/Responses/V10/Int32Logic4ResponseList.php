<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V10;

class Int32Logic4ResponseList
{
    /**
     * @param array<int>    $records
     * @param array<string> $validationMessages
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
            records: $data['Records'] ?? [],
            recordsCounter: $data['RecordsCounter'] ?? 0,
            validationMessages: $data['ValidationMessages'] ?? [],
        );
    }
}
