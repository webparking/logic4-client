<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V11;

class ReturnProblemV11
{
    /** @param array<ReturnSolution> $solutions */
    public function __construct(
        public ?array $solutions,
        public int $id,
        public ?string $name,
        public ?string $description,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            solutions: array_map(static fn (array $item) => ReturnSolution::make($item), $data['Solutions'] ?? []),
            id: $data['Id'] ?? 0,
            name: $data['Name'] ?? null,
            description: $data['Description'] ?? null,
        );
    }
}
