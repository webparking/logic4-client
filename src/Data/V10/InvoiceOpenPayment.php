<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V10;

class InvoiceOpenPayment
{
    public function __construct(
        public int $invoiceId,
        public int $debtorId,
        public ?\Carbon\Carbon $dueDate,
        public ?\Carbon\Carbon $invoiceDate,
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
            invoiceId: $data['InvoiceId'] ?? 0,
            debtorId: $data['DebtorId'] ?? 0,
            dueDate: isset($data['DueDate']) ? \Carbon\Carbon::parse($data['DueDate']) : null,
            invoiceDate: isset($data['InvoiceDate']) ? \Carbon\Carbon::parse($data['InvoiceDate']) : null,
            daysPastDueDate: $data['DaysPastDueDate'] ?? 0,
            totalAmount: $data['TotalAmount'] ?? 0.0,
            totalAmountPayed: $data['TotalAmountPayed'] ?? 0.0,
            amountOutstanding: $data['AmountOutstanding'] ?? 0.0,
            paymentMethodId: $data['PaymentMethodId'] ?? 0,
        );
    }
}
