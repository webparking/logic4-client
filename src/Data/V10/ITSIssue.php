<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class ITSIssue
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?\Carbon\Carbon $dateTimeCreatedOn,
        public ?\Carbon\Carbon $dateTimeClosed,
        public int $createdByUserId,
        public ?string $description,
        public ?int $orderId,
        public ?int $invoiceId,
        public ?ITSIssueStatus $status,
        public ?ITSIssueType $type,
        public ?int $responsibleByUserId,
        public ?string $responsibleByUserName,
        public ?\Carbon\Carbon $dateTimeMustBeCompletedOn,
        public ?string $freeValue1,
        public ?string $freeValue2,
        public ?ITSPriority $priority,
        public ?ITSProject $project,
        public ?ITSIssueGroup $group,
        public ?ITSIssueLevel $level,
        public ?BasicProductData $productData,
        public ?ITSIssueFreeType $freeValueType1,
        public ?ITSIssueFreeType $freeValueType2,
        public ?\Carbon\Carbon $lastModifiedSince,
        public ?int $reportedByDebtorId,
        public ?int $reportedByCreditorId,
        public ?int $contactId,
        public ?\Carbon\Carbon $dateTimeReported,
        public bool $archiveIssue,
        public ?int $minutes,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['id'] ?? 0,
            name: $data['Name'] ?? null,
            dateTimeCreatedOn: isset($data['DateTimeCreatedOn']) ? \Carbon\Carbon::parse($data['DateTimeCreatedOn']) : null,
            dateTimeClosed: isset($data['DateTimeClosed']) ? \Carbon\Carbon::parse($data['DateTimeClosed']) : null,
            createdByUserId: $data['CreatedByUserId'] ?? 0,
            description: $data['Description'] ?? null,
            orderId: $data['OrderId'] ?? null,
            invoiceId: $data['InvoiceId'] ?? null,
            status: isset($data['Status']) ? ITSIssueStatus::make($data['Status']) : null,
            type: isset($data['Type']) ? ITSIssueType::make($data['Type']) : null,
            responsibleByUserId: $data['ResponsibleByUserId'] ?? null,
            responsibleByUserName: $data['ResponsibleByUserName'] ?? null,
            dateTimeMustBeCompletedOn: isset($data['DateTimeMustBeCompletedOn']) ? \Carbon\Carbon::parse($data['DateTimeMustBeCompletedOn']) : null,
            freeValue1: $data['FreeValue1'] ?? null,
            freeValue2: $data['FreeValue2'] ?? null,
            priority: isset($data['Priority']) ? ITSPriority::make($data['Priority']) : null,
            project: isset($data['Project']) ? ITSProject::make($data['Project']) : null,
            group: isset($data['Group']) ? ITSIssueGroup::make($data['Group']) : null,
            level: isset($data['Level']) ? ITSIssueLevel::make($data['Level']) : null,
            productData: isset($data['ProductData']) ? BasicProductData::make($data['ProductData']) : null,
            freeValueType1: isset($data['FreeValueType1']) ? ITSIssueFreeType::make($data['FreeValueType1']) : null,
            freeValueType2: isset($data['FreeValueType2']) ? ITSIssueFreeType::make($data['FreeValueType2']) : null,
            lastModifiedSince: isset($data['LastModifiedSince']) ? \Carbon\Carbon::parse($data['LastModifiedSince']) : null,
            reportedByDebtorId: $data['ReportedByDebtorId'] ?? null,
            reportedByCreditorId: $data['ReportedByCreditorId'] ?? null,
            contactId: $data['ContactId'] ?? null,
            dateTimeReported: isset($data['DateTimeReported']) ? \Carbon\Carbon::parse($data['DateTimeReported']) : null,
            archiveIssue: $data['ArchiveIssue'] ?? false,
            minutes: $data['Minutes'] ?? null,
        );
    }
}
