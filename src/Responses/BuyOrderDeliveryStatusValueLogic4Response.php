<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses;

use Webparking\Logic4Client\Data\BuyOrderDeliveryStatusValue;

class BuyOrderDeliveryStatusValueLogic4Response
{
    /** @param array<string> $validationMessages */
    public function __construct(
        public ?BuyOrderDeliveryStatusValue $value,
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: $data['Value'] ? BuyOrderDeliveryStatusValue::make($data['Value']) : null,
            validationMessages: $data['ValidationMessages'],
        );
    }
}
