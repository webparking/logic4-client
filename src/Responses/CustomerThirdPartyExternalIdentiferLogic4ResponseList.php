<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses;

use Webparking\Logic4Client\Data\CustomerThirdPartyExternalIdentifer;

class CustomerThirdPartyExternalIdentiferLogic4ResponseList
{
    /**
     * @param array<CustomerThirdPartyExternalIdentifer> $records
     * @param array<string>                              $validationMessages
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
            records: array_map(static fn (array $item) => CustomerThirdPartyExternalIdentifer::make($item), $data['Records'] ?? []),
            recordsCounter: $data['RecordsCounter'],
            validationMessages: $data['ValidationMessages'],
        );
    }
}
