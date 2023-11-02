<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses;

use Webparking\Logic4Client\Data\OrderOpenPayment;

class OrderOpenPaymentLogic4Response
{
    /** @param array<string> $validationMessages */
    public function __construct(
        public ?OrderOpenPayment $value,
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: isset($data['Value']) ? OrderOpenPayment::make($data['Value']) : null,
            validationMessages: $data['ValidationMessages'] ?? [],
        );
    }
}
