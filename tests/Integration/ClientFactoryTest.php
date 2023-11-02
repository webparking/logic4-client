<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Integration;

use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Psr\Http\Message\RequestInterface;
use Webparking\Logic4Client\AccessTokenManager;
use Webparking\Logic4Client\ClientFactory;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Tests\TestCase;

final class ClientFactoryTest extends TestCase
{
    public function testRequestHasBearerTokenFromAccessTokenManager(): void
    {
        $accessTokenManager = \Mockery::mock(AccessTokenManager::class, static function (MockInterface $mock): void {
            $mock->shouldReceive('getAccessToken')->once()->andReturn('some-access-token');
        });

        $handlerStack = HandlerStack::create(new MockHandler([
            new Response(200, [], 'some-contents'),
        ]));

        $clientFactory = new ClientFactory($accessTokenManager);
        $clientFactory->setHandlerStack($handlerStack);

        $handlerStack->push(Middleware::mapRequest(static function (RequestInterface $request) {
            static::assertSame('Bearer some-access-token', $request->getHeaderLine('Authorization'));
            static::assertSame('https://api.logic4server.nl/some-url.html', $request->getUri()->__toString());

            return $request;
        }));

        $response = $clientFactory->make()->get('some-url.html');

        static::assertSame(200, $response->getStatusCode());
        static::assertSame('some-contents', $response->getBody()->getContents());
    }

    public function testFailedRequestResultsInException(): void
    {
        $accessTokenManager = \Mockery::mock(AccessTokenManager::class, function (MockInterface $mock): void {
            $mock->shouldReceive('getAccessToken')->once();
        });

        $handlerStack = HandlerStack::create(new MockHandler([
            new Response(500, [], 'Internal Server Error'),
        ]));

        $client = (new ClientFactory($accessTokenManager))->setHandlerStack($handlerStack)->make();

        $exception = null;
        try {
            $client->get('some-url.html');
        } catch (\Throwable $exception) {
        }

        static::assertInstanceOf(Logic4ApiException::class, $exception);
        static::assertSame(
            "Server error: `GET https://api.logic4server.nl/some-url.html` resulted in a `500 Internal Server Error` response:\nInternal Server Error\n",
            $exception->getMessage()
        );

        static::assertInstanceOf(ServerException::class, $exception->getPrevious());
    }

    public function testPreventStrayRequestsWhenEnabled(): void
    {
        ClientFactory::preventStrayRequests();

        $client = (new ClientFactory(\Mockery::mock(AccessTokenManager::class)))
            ->make();

        try {
            $client->get('some-url.html');

            static::fail('Expected exception to be thrown.');
        } catch (\RuntimeException $exception) {
            static::assertInstanceOf(\RuntimeException::class, $exception);
            static::assertSame('Attempting to make a request while stray requests are prevented.', $exception->getMessage());
        } finally {
            ClientFactory::preventStrayRequests(false);
        }
    }
}
