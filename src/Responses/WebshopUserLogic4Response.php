<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses;

use Webparking\Logic4Client\Data\WebshopUser;

class WebshopUserLogic4Response
{
    /** @param array<string> $validationMessages */
    public function __construct(
        public ?WebshopUser $value,
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: $data['Value'] ? WebshopUser::make($data['Value']) : null,
            validationMessages: $data['ValidationMessages'],
        );
    }
}
