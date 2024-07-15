<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Responses\V10;

class CompanyInformationLogic4Response
{
    /** @param array<string> $validationMessages */
    public function __construct(
        public ?\Webparking\Logic4Client\Data\V10\CompanyInformation $value,
        public array $validationMessages,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            value: isset($data['Value']) ? \Webparking\Logic4Client\Data\V10\CompanyInformation::make($data['Value']) : null,
            validationMessages: $data['ValidationMessages'] ?? [],
        );
    }
}
