<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Integration;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Requests\V20\ProductRequest;
use Webparking\Logic4Client\Tests\TestCase;

final class PaginatedRequestTest extends TestCase
{
    public function testRequestDataUntilNoRecordsAreLeft(): void
    {
        $client = \Mockery::mock(Client::class, static function (MockInterface $mock): void {
            $record = [
                'WebsiteDomainId' => null,
                'GlobalizationId' => null,
                'ProductId' => 123,
                'Title' => null,
                'Description' => null,
                'USP' => null,
                'MetaName' => null,
                'MetaDescription' => null,
            ];

            $mock->shouldReceive('post')
                ->once()
                ->with('/v2/Products/GetProductsSEOInformation', [
                    'json' => [
                        'ProductIds' => [1, 2, 3],
                        'TakeRecords' => 1000,
                        'SkipRecords' => 0,
                    ],
                ])
                ->andReturn(new Response(200, body: json_encode([
                    'Records' => [$record],
                    'RecordsCounter' => 1000,
                    'ValidationMessages' => [],
                ], \JSON_THROW_ON_ERROR)));

            $mock->shouldReceive('post')
                ->once()
                ->with('/v2/Products/GetProductsSEOInformation', [
                    'json' => [
                        'TakeRecords' => 1000,
                        'SkipRecords' => 1000,
                        'ProductIds' => [1, 2, 3],
                    ],
                ])
                ->andReturn(new Response(200, body: json_encode([
                    'Records' => [$record],
                    'RecordsCounter' => 1000,
                    'ValidationMessages' => [],
                ], \JSON_THROW_ON_ERROR)));

            $mock->shouldReceive('post')
                ->once()
                ->with('/v2/Products/GetProductsSEOInformation', [
                    'json' => [
                        'TakeRecords' => 1000,
                        'SkipRecords' => 2000,
                        'ProductIds' => [1, 2, 3],
                    ],
                ])
                ->andReturn(new Response(200, body: json_encode([
                    'Records' => [$record],
                    'RecordsCounter' => 150,
                    'ValidationMessages' => [],
                ], \JSON_THROW_ON_ERROR)));
        });

        $request = new ProductRequest(\Mockery::mock(ClientFactory::class));

        $request->setClient($client);

        $iterator = $request->getProductsSEOInformation(['ProductIds' => [1, 2, 3]]);
        $data = iterator_to_array($iterator);

        static::assertCount(3, $data);
        static::assertSame(123, $data[0]->productId);
    }

    public function testPaginatedResponseObjectIsTraversable(): void
    {
        $client = \Mockery::mock(Client::class, static function (MockInterface $mock): void {
            $record = [
                'WebsiteDomainId' => null,
                'GlobalizationId' => null,
                'ProductId' => 123,
                'Title' => null,
                'Description' => null,
                'USP' => null,
                'MetaName' => null,
                'MetaDescription' => null,
            ];

            $mock->shouldReceive('post')
                ->once()
                ->with('/v2/Products/GetProductsSEOInformation', [
                    'json' => [
                        'ProductIds' => [1, 2, 3],
                        'TakeRecords' => 1000,
                        'SkipRecords' => 0,
                    ],
                ])
                ->andReturn(new Response(200, body: json_encode([
                    'Records' => [$record],
                    'RecordsCounter' => 1000,
                    'ValidationMessages' => [],
                ], \JSON_THROW_ON_ERROR)));

            $mock->shouldReceive('post')
                ->once()
                ->with('/v2/Products/GetProductsSEOInformation', [
                    'json' => [
                        'TakeRecords' => 1000,
                        'SkipRecords' => 1000,
                        'ProductIds' => [1, 2, 3],
                    ],
                ])
                ->andReturn(new Response(200, body: json_encode([
                    'Records' => [$record],
                    'RecordsCounter' => 100,
                    'ValidationMessages' => [],
                ], \JSON_THROW_ON_ERROR)));
        });

        $request = new ProductRequest(\Mockery::mock(ClientFactory::class));
        $request->setClient($client);

        $response = $request->getProductsSEOInformation(['ProductIds' => [1, 2, 3]]);

        $traversed = 0;
        foreach ($response as $item) {
            ++$traversed;

            static::assertSame(123, $item->productId);
        }

        static::assertSame(2, $traversed);
    }
}
