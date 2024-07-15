<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V10;

class HRMTimeRegistrationRowListLogic4Response
{
    /**
     * @param array<\Webparking\Logic4Client\Data\V10\HRMTimeRegistrationRow> $value
     * @param array<string>                                                   $validationMessages
     */
    public function __construct(
        public ?array $value,
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: array_map(static fn (array $item) => \Webparking\Logic4Client\Data\V10\HRMTimeRegistrationRow::make($item), $data['Value'] ?? []),
            validationMessages: $data['ValidationMessages'] ?? [],
        );
    }
}
