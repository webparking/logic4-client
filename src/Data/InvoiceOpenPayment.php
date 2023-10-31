<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data;

use Carbon\Carbon;

class InvoiceOpenPayment
{
    public function __construct(
        public int $invoiceId,
        public int $debtorId,
        public ?Carbon $dueDate,
        public ?Carbon $invoiceDate,
        public int $daysPastDueDate,
        public float $totalAmount,
        public float $totalAmountPayed,
        public float $amountOutstanding,
        public int $paymentMethodId,
    ) {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
            invoiceId: $data['InvoiceId'],
            debtorId: $data['DebtorId'],
            dueDate: $data['DueDate'] ? Carbon::parse($data['DueDate']) : null,
            invoiceDate: $data['InvoiceDate'] ? Carbon::parse($data['InvoiceDate']) : null,
            daysPastDueDate: $data['DaysPastDueDate'],
            totalAmount: $data['TotalAmount'],
            totalAmountPayed: $data['TotalAmountPayed'],
            amountOutstanding: $data['AmountOutstanding'],
            paymentMethodId: $data['PaymentMethodId'],
        );
    }
}
