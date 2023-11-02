<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class CompanyValues
{
    public function __construct(
        public bool $useMultipleAdministrations,
        public bool $isMultiChannel,
        public bool $branchSpecificInventoryAndBuyorderSystem,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            useMultipleAdministrations: $data['UseMultipleAdministrations'] ?? false,
            isMultiChannel: $data['IsMultiChannel'] ?? false,
            branchSpecificInventoryAndBuyorderSystem: $data['BranchSpecificInventoryAndBuyorderSystem'] ?? false,
        );
    }
}
