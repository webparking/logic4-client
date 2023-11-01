<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Integration;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\MockInterface;
use Psr\SimpleCache\CacheInterface;
use Webparking\Logic4Client\AccessTokenManager;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;
use Webparking\Logic4Client\Tests\TestCase;

final class AccessTokenManagerTest extends TestCase
{
    /** @var array{
     *     public_key: string,
     *     company_key: string,
     *     username: string,
     *     secret_key: string,
     *     password: string,
     *     administration_id: string,
     *  }
     */
    private array $credentials;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = [
            'public_key' => 'publicKey',
            'company_key' => 'companyKey',
            'username' => 'user_name (2)',
            'secret_key' => 'secretKey',
            'password' => 'password',
            'administration_id' => 'administration-1',
        ];
    }

    public function testGetFromLogic4WhenNotInCache(): void
    {
        $cache = \Mockery::mock(CacheInterface::class, static function (MockInterface $mock): void {
            $mock->shouldReceive('has')
                ->once()
                ->with('logic4:access_token')
                ->andReturnFalse();

            $mock->shouldReceive('set')
                ->once()
                ->with('logic4:access_token', 'the-new-access-token', 3600);
        });

        $client = \Mockery::mock(Client::class, function (MockInterface $mock): void {
            $mock->shouldReceive('post')
                ->once()
                ->withArgs(function (string $url, array $contents): bool {
                    static::assertSame('https://idp.logic4server.nl/token', $url);
                    static::assertSame([
                        'form_params' => [
                            'client_id' => 'publicKey companyKey user__name_(2)',
                            'client_secret' => 'secretKey password',
                            'scope' => 'api administration.administration-1',
                            'grant_type' => 'client_credentials',
                        ],
                    ], $contents);

                    return true;
                })
                ->andReturn(new Response(200, [], json_encode([
                    'access_token' => 'the-new-access-token',
                    'expires_in' => 3600,
                ], \JSON_THROW_ON_ERROR)));
        });

        $manager = new AccessTokenManager($cache, $client);
        $manager->configure($this->credentials);

        static::assertSame(
            'the-new-access-token',
            $manager->getAccessToken(),
        );
    }

    public function testGetFromCache(): void
    {
        $cache = \Mockery::mock(CacheInterface::class, static function (MockInterface $mock): void {
            $mock->shouldReceive('has')
                ->once()
                ->with('logic4:access_token')
                ->andReturnTrue();

            $mock->shouldReceive('get')
                ->once()
                ->with('logic4:access_token')
                ->andReturn('the-access-token');
        });

        $manager = new AccessTokenManager($cache);
        $manager->configure($this->credentials);

        static::assertSame(
            'the-access-token',
            $manager->getAccessToken(),
        );
    }

    public function testExceptionThrownWhenFailedToFetchAccessToken(): void
    {
        $cache = \Mockery::mock(CacheInterface::class, static function (MockInterface $mock): void {
            $mock->shouldReceive('has')
                ->once()
                ->with('logic4:access_token')
                ->andReturnFalse();
        });

        $client = \Mockery::mock(Client::class, function (MockInterface $mock): void {
            $mock->shouldReceive('post')
                ->once()
                ->with('https://idp.logic4server.nl/token', \Mockery::type('array'))
                ->andReturn(new Response(400, [], json_encode([
                    'error' => 'invalid_client',
                    'error_description' => 'Invalid client credentials',
                ], \JSON_THROW_ON_ERROR)));
        });

        $manager = new AccessTokenManager($cache, $client);
        $manager->configure($this->credentials);

        $this->expectExceptionObject(new Logic4ApiException('Could not get access token: {"error":"invalid_client","error_description":"Invalid client credentials"}'));

        $manager->getAccessToken();
    }
}
