<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

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
        public ?Carbon $dateTime,
        public ?Carbon $internalDateTime,
        public ?int $productId,
        public ?string $productCode,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            ledgerId: $data['LedgerId'],
            ledgerCode: $data['LedgerCode'],
            bookingId: $data['BookingId'],
            invoiceNr: $data['InvoiceNr'],
            creditorId: $data['CreditorId'],
            debtorId: $data['DebtorId'],
            description: $data['Description'],
            costCenterId: $data['CostCenterId'],
            transactionCodeId: $data['TransactionCodeId'],
            entityCodeId: $data['EntityCodeId'],
            amount: $data['Amount'],
            amountDebit: $data['AmountDebit'],
            amountCredit: $data['AmountCredit'],
            vatAmount: $data['VatAmount'],
            vatPercent: $data['VatPercent'],
            vatId: $data['VatId'],
            userId: $data['UserId'],
            dateTime: $data['DateTime'] ? Carbon::parse($data['DateTime']) : null,
            internalDateTime: $data['InternalDateTime'] ? Carbon::parse($data['InternalDateTime']) : null,
            productId: $data['ProductId'],
            productCode: $data['ProductCode'],
        );
    }
}
