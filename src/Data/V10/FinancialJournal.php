<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class FinancialJournal
{
    public function __construct(
        public ?int $ledgerId,
        public ?int $ledgerCode,
        public ?int $bookingId,
        public ?int $invoiceNr,
        public ?int $creditorId,
        public ?int $debtorId,
        public ?string $description,
        public ?int $costCenterId,
        public ?int $transactionCodeId,
        public ?int $entityCodeId,
        public ?float $amount,
        public ?float $amountDebit,
        public ?float $amountCredit,
        public ?float $vatAmount,
        public ?float $vatPercent,
        public ?int $vatId,
        public ?int $userId,
        public ?\Carbon\Carbon $dateTime,
        public ?\Carbon\Carbon $internalDateTime,
        public ?int $productId,
        public ?string $productCode,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            ledgerId: $data['LedgerId'] ?? null,
            ledgerCode: $data['LedgerCode'] ?? null,
            bookingId: $data['BookingId'] ?? null,
            invoiceNr: $data['InvoiceNr'] ?? null,
            creditorId: $data['CreditorId'] ?? null,
            debtorId: $data['DebtorId'] ?? null,
            description: $data['Description'] ?? null,
            costCenterId: $data['CostCenterId'] ?? null,
            transactionCodeId: $data['TransactionCodeId'] ?? null,
            entityCodeId: $data['EntityCodeId'] ?? null,
            amount: $data['Amount'] ?? null,
            amountDebit: $data['AmountDebit'] ?? null,
            amountCredit: $data['AmountCredit'] ?? null,
            vatAmount: $data['VatAmount'] ?? null,
            vatPercent: $data['VatPercent'] ?? null,
            vatId: $data['VatId'] ?? null,
            userId: $data['UserId'] ?? null,
            dateTime: isset($data['DateTime']) ? \Carbon\Carbon::parse($data['DateTime']) : null,
            internalDateTime: isset($data['InternalDateTime']) ? \Carbon\Carbon::parse($data['InternalDateTime']) : null,
            productId: $data['ProductId'] ?? null,
            productCode: $data['ProductCode'] ?? null,
        );
    }
}
