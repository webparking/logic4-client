<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use Webparking\Logic4Client\Data\V10\Order;
use Webparking\Logic4Client\Tests\TestCase;

final class OrderDataTest extends TestCase
{
    public function testMakeOrderWithMinimalValues(): void
    {
        $order = Order::make([
            'Id' => 12,
            'DebtorId' => 55,
        ]);

        static::assertSame(12, $order->id);
        static::assertSame(55, $order->debtorId);
        static::assertSame([], $order->orderRows);
        static::assertNull($order->totals);
    }
}
