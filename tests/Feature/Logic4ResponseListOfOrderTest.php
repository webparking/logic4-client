<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use Webparking\Logic4Client\Responses\V10\Logic4ResponseListOfOrder;
use Webparking\Logic4Client\Tests\TestCase;

final class Logic4ResponseListOfOrderTest extends TestCase
{
    public function testMakeWithMinimalData(): void
    {
        $data = Logic4ResponseListOfOrder::make([]);

        static::assertSame([], $data->records);
        static::assertSame(0, $data->recordsCounter);
        static::assertSame([], $data->validationMessages);
    }
}
