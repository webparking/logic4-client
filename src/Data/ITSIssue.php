<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class ITSIssue
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?Carbon $dateTimeCreatedOn,
        public ?Carbon $dateTimeClosed,
        public int $createdByUserId,
        public ?string $description,
        public ?int $orderId,
        public ?int $invoiceId,
        public ?ITSIssueStatus $status,
        public ?ITSIssueType $type,
        public ?int $responsibleByUserId,
        public ?string $responsibleByUserName,
        public ?Carbon $dateTimeMustBeCompletedOn,
        public ?string $freeValue1,
        public ?string $freeValue2,
        public ?ITSPriority $priority,
        public ?ITSProject $project,
        public ?ITSIssueGroup $group,
        public ?ITSIssueLevel $level,
        public ?BasicProductData $productData,
        public ?ITSIssueFreeType $freeValueType1,
        public ?ITSIssueFreeType $freeValueType2,
        public ?Carbon $lastModifiedSince,
        public ?int $reportedByDebtorId,
        public ?int $reportedByCreditorId,
        public ?int $contactId,
        public ?Carbon $dateTimeReported,
        public bool $archiveIssue,
        public ?int $minutes,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['Name'],
            dateTimeCreatedOn: $data['DateTimeCreatedOn'] ? Carbon::parse($data['DateTimeCreatedOn']) : null,
            dateTimeClosed: $data['DateTimeClosed'] ? Carbon::parse($data['DateTimeClosed']) : null,
            createdByUserId: $data['CreatedByUserId'],
            description: $data['Description'],
            orderId: $data['OrderId'],
            invoiceId: $data['InvoiceId'],
            status: $data['Status'] ? ITSIssueStatus::make($data['Status']) : null,
            type: $data['Type'] ? ITSIssueType::make($data['Type']) : null,
            responsibleByUserId: $data['ResponsibleByUserId'],
            responsibleByUserName: $data['ResponsibleByUserName'],
            dateTimeMustBeCompletedOn: $data['DateTimeMustBeCompletedOn'] ? Carbon::parse($data['DateTimeMustBeCompletedOn']) : null,
            freeValue1: $data['FreeValue1'],
            freeValue2: $data['FreeValue2'],
            priority: $data['Priority'] ? ITSPriority::make($data['Priority']) : null,
            project: $data['Project'] ? ITSProject::make($data['Project']) : null,
            group: $data['Group'] ? ITSIssueGroup::make($data['Group']) : null,
            level: $data['Level'] ? ITSIssueLevel::make($data['Level']) : null,
            productData: $data['ProductData'] ? BasicProductData::make($data['ProductData']) : null,
            freeValueType1: $data['FreeValueType1'] ? ITSIssueFreeType::make($data['FreeValueType1']) : null,
            freeValueType2: $data['FreeValueType2'] ? ITSIssueFreeType::make($data['FreeValueType2']) : null,
            lastModifiedSince: $data['LastModifiedSince'] ? Carbon::parse($data['LastModifiedSince']) : null,
            reportedByDebtorId: $data['ReportedByDebtorId'],
            reportedByCreditorId: $data['ReportedByCreditorId'],
            contactId: $data['ContactId'],
            dateTimeReported: $data['DateTimeReported'] ? Carbon::parse($data['DateTimeReported']) : null,
            archiveIssue: $data['ArchiveIssue'],
            minutes: $data['Minutes'],
        );
    }
}
