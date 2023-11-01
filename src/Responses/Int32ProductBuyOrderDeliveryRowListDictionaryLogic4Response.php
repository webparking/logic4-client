<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses;

class Int32ProductBuyOrderDeliveryRowListDictionaryLogic4Response
{
    /** @param array<string> $validationMessages */
    public function __construct(
        public ?object $value,
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: $data['Value'],
            validationMessages: $data['ValidationMessages'],
        );
    }
}
