<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use Webparking\Logic4Client\Responses\OrderLogic4ResponseList;
use Webparking\Logic4Client\Tests\TestCase;

final class OrderLogic4ResponseListTest extends TestCase
{
    public function testMakeWithMinimalData(): void
    {
        $data = OrderLogic4ResponseList::make([]);

        static::assertSame([], $data->records);
        static::assertSame(0, $data->recordsCounter);
        static::assertSame([], $data->validationMessages);
    }
}
