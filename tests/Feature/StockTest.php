<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Requests\StockRequest;
use Webparking\Logic4Client\Tests\TestCase;

final class StockTest extends TestCase
{
    public function testResponseWithValueInArray(): void
    {
        $client = \Mockery::mock(Client::class, static function (MockInterface $mock): void {
            $mock->shouldReceive('post')
                ->once()
                ->with('/v1/Stock/SetExternalStockForSupplier', ['json' => [
                    'SupplierId' => 61231,
                    'ProductId' => 61,
                    'Quantity' => 12,
                ]])
                ->andReturn(new Response(body: json_encode([
                    'Value' => true,
                    'ValidationMessages' => [],
                ], \JSON_THROW_ON_ERROR)));
        });

        $clientFactory = \Mockery::mock(ClientFactory::class, static function (MockInterface $mock) use ($client): void {
            $mock->shouldReceive('make')
                ->once()
                ->andReturn($client);
        });

        $response = (new StockRequest($clientFactory))->setExternalStockForSupplier([
            'SupplierId' => 61231,
            'ProductId' => 61,
            'Quantity' => 12,
        ]);

        static::assertTrue($response->value);
        static::assertSame([], $response->validationMessages);
    }
}
