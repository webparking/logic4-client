<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Requests\V30\ProductRequest;
use Webparking\Logic4Client\Tests\TestCase;

final class ProductMediaTest extends TestCase
{
    public function testGetProductMediaDecodesStringResourceType(): void
    {
        $client = \Mockery::mock(Client::class, static function (MockInterface $mock): void {
            $mock->shouldReceive('post')
                ->once()
                ->with('/v3/Products/GetProductMedia', ['json' => ['ProductIds' => [123]]])
                ->andReturn(new Response(body: json_encode([
                    [
                        'ProductId' => 123,
                        'Resources' => [
                            [
                                'FileName' => 'photo.jpg',
                                'Type' => 'Photo',
                                'Description' => 'Front',
                                'Sorting' => 1,
                                'Url' => 'https://example.test/photo.jpg',
                            ],
                        ],
                    ],
                ], \JSON_THROW_ON_ERROR)));
        });

        $clientFactory = \Mockery::mock(ClientFactory::class, static function (MockInterface $mock) use ($client): void {
            $mock->shouldReceive('make')
                ->once()
                ->andReturn($client);
        });

        $mediaFiles = (new ProductRequest($clientFactory))->getProductMedia(['ProductIds' => [123]]);

        static::assertCount(1, $mediaFiles);
        static::assertSame(123, $mediaFiles[0]->productId);
        static::assertNotNull($mediaFiles[0]->resources);
        static::assertSame('Photo', $mediaFiles[0]->resources[0]->type);
        static::assertSame('photo.jpg', $mediaFiles[0]->resources[0]->fileName);
    }
}
