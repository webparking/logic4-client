<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Requests\ProductRequest;
use Webparking\Logic4Client\Tests\TestCase;

final class ProductTest extends TestCase
{
    public function testPostRequestWithNumericBody(): void
    {
        $client = \Mockery::mock(Client::class, function (MockInterface $mock): void {
            $mock->shouldReceive('post')
                ->once()
                ->with('/v1.1/Products/GetSuppliersForProduct', ['json' => 777])
                ->andReturn(new Response(body: json_encode([
                    'Records' => [],
                    'RecordsCounter' => 0,
                    'ValidationMessages' => [],
                ], \JSON_THROW_ON_ERROR)));
        });

        $clientFactory = \Mockery::mock(ClientFactory::class, static function (MockInterface $mock) use ($client): void {
            $mock->shouldReceive('make')
                ->once()
                ->andReturn($client);
        });

        $response = (new ProductRequest($clientFactory))->getSuppliersForProduct(777);

        static::assertSame(0, $response->recordsCounter);
    }
}
