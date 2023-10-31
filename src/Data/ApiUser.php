<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

class ApiUser
{
    public function __construct(
        public ?string $fullName,
        public int $userId,
        public ?string $username,
        public ?string $employeeNumber,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            fullName: $data['FullName'],
            userId: $data['UserId'],
            username: $data['Username'],
            employeeNumber: $data['EmployeeNumber'],
        );
    }
}
