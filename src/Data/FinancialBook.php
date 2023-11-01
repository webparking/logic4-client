<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class FinancialBook
{
    public function __construct(
        public int $id,
        public int $financialBookType,
        public ?string $name,
        public ?int $ledgerId,
        public int $administrationId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['Id'],
            financialBookType: $data['FinancialBookType'],
            name: $data['Name'],
            ledgerId: $data['LedgerId'],
            administrationId: $data['AdministrationId'],
        );
    }
}
