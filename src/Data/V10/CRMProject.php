<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class CRMProject
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?\Carbon\Carbon $createdOnDateTime,
        public ?\Carbon\Carbon $dateTimeStart,
        public ?\Carbon\Carbon $dateTimeEnd,
        public int $createdByUserId,
        public ?string $shortDescription,
        public ?CRMProjectStatus $status,
        public ?CRMProjectType $type,
        public ?int $responsibleByUserId,
        public ?string $responsibleByUserName,
        public ?float $projectValue,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['id'] ?? 0,
            name: $data['Name'] ?? null,
            createdOnDateTime: isset($data['CreatedOnDateTime']) ? \Carbon\Carbon::parse($data['CreatedOnDateTime']) : null,
            dateTimeStart: isset($data['DateTimeStart']) ? \Carbon\Carbon::parse($data['DateTimeStart']) : null,
            dateTimeEnd: isset($data['DateTimeEnd']) ? \Carbon\Carbon::parse($data['DateTimeEnd']) : null,
            createdByUserId: $data['CreatedByUserId'] ?? 0,
            shortDescription: $data['ShortDescription'] ?? null,
            status: isset($data['Status']) ? CRMProjectStatus::make($data['Status']) : null,
            type: isset($data['Type']) ? CRMProjectType::make($data['Type']) : null,
            responsibleByUserId: $data['ResponsibleByUserId'] ?? null,
            responsibleByUserName: $data['ResponsibleByUserName'] ?? null,
            projectValue: $data['ProjectValue'] ?? null,
        );
    }
}
