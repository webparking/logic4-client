<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Requests\V30\PickbonsRequest;
use Webparking\Logic4Client\Tests\TestCase;

final class PickbonsRequestTest extends TestCase
{
    public function testProcessPickbonsReturnsRawStringBody(): void
    {
        $client = \Mockery::mock(Client::class, static function (MockInterface $mock): void {
            $mock->shouldReceive('post')
                ->once()
                ->with('/v3/Pickbons/ProcessPickbons', ['json' => [['OrderHeadPickbonId' => 42]]])
                ->andReturn(new Response(body: 'PB-2026-0042'));
        });

        $clientFactory = \Mockery::mock(ClientFactory::class, static function (MockInterface $mock) use ($client): void {
            $mock->shouldReceive('make')
                ->once()
                ->andReturn($client);
        });

        $response = (new PickbonsRequest($clientFactory))->processPickbons([['OrderHeadPickbonId' => 42]]);

        static::assertSame('PB-2026-0042', $response);
    }
}
