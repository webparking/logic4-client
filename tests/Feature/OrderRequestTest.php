<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Requests\OrderRequest;
use Webparking\Logic4Client\Tests\TestCase;

final class OrderRequestTest extends TestCase
{
    public function testGetOrderStatuses(): void
    {
        $client = \Mockery::mock(Client::class, function (MockInterface $mock): void {
            $mock->shouldReceive('get')
                ->once()
                ->with('/v1/Orders/GetOrderStatuses')
                ->andReturn(new Response(body: json_encode([
                    'Records' => [
                        ['Id' => 12, 'Value' => 'Open'],
                        ['Id' => 13, 'Value' => 'Closed'],
                    ],
                    'RecordsCounter' => 192,
                    'ValidationMessages' => [
                        'some-message',
                    ],
                ], \JSON_THROW_ON_ERROR)));
        });

        $clientFactory = \Mockery::mock(ClientFactory::class, static function (MockInterface $mock) use ($client): void {
            $mock->shouldReceive('make')
                ->once()
                ->andReturn($client);
        });

        $response = (new OrderRequest($clientFactory))->getOrderStatuses();

        static::assertSame(192, $response->recordsCounter);
        static::assertSame(['some-message'], $response->validationMessages);
        static::assertCount(2, $response->records);
        static::assertSame(12, $response->records[0]->id);
        static::assertSame('Open', $response->records[0]->value);
        static::assertSame(13, $response->records[1]->id);
        static::assertSame('Closed', $response->records[1]->value);
    }

    public function testPostReturnOrders(): void
    {
        $client = \Mockery::mock(Client::class, function (MockInterface $mock): void {
            $orderData = get_class_vars(\Webparking\Logic4Client\Data\ReturnOrderV2::class);
            $orderData = [
                ...array_combine(array_map(ucfirst(...), array_keys($orderData)), array_values($orderData)),
                'DebtorId' => 51,
                'Id' => 9912,
            ];

            $mock->shouldReceive('post')
                ->once()
                ->with('/v2/Orders/GetReturnOrders', [
                    'json' => [
                        'TakeRecords' => 1000,
                        'SkipRecords' => 0,
                        'StatusId' => 9,
                    ],
                ])
                ->andReturn(new Response(body: json_encode([
                    'Records' => [
                        $orderData,
                    ],
                    'RecordsCounter' => 1,
                    'ValidationMessages' => [],
                ], \JSON_THROW_ON_ERROR)));
        });

        $clientFactory = \Mockery::mock(ClientFactory::class, static function (MockInterface $mock) use ($client): void {
            $mock->shouldReceive('make')
                ->once()
                ->andReturn($client);
        });

        $response = (new OrderRequest($clientFactory))->getReturnOrders([
            'StatusId' => 9,
        ]);
        $data = iterator_to_array($response);

        static::assertCount(1, $data);
        static::assertSame(51, $data[0]->debtorId);
        static::assertSame(9912, $data[0]->id);
    }
}
