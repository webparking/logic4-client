<?php

declare(strict_types=1);

namespace Webparking\Logic4Client;

use GuzzleHttp\Client;
use Psr\SimpleCache\CacheInterface;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;

class AccessTokenManager
{
    private string $publicKey;
    private string $companyKey;
    private string $username;
    private string $secretKey;
    private string $password;
    private string $administrationId;

    public function __construct(
        private readonly CacheInterface $cache,
        private readonly Client $client = new Client(),
        private readonly string $tokenUrl = 'https://idp.logic4server.nl/token',
    ) {
    }

    /** @param array{
     *     public_key: string,
     *     company_key: string,
     *     username: string,
     *     secret_key: string,
     *     password: string,
     *     administration_id: string,
     *  } $options
     */
    public function configure(array $options): void
    {
        $this->publicKey = $options['public_key'];
        $this->companyKey = $options['company_key'];
        $this->username = $options['username'];
        $this->secretKey = $options['secret_key'];
        $this->password = $options['password'];
        $this->administrationId = $options['administration_id'];
    }

    public function getAccessToken(): string
    {
        $cacheKey = 'logic4:access_token:'.base64_encode($this->makeClientId().':'.$this->makeScope());

        if (null !== $accessToken = $this->cache->get($cacheKey)) {
            return $accessToken;
        }

        $response = $this->client
            ->post($this->tokenUrl, [
                'form_params' => [
                    'client_id' => $this->makeClientId(),
                    'client_secret' => $this->makeClientSecret(),
                    'scope' => $this->makeScope(),
                    'grant_type' => 'client_credentials',
                ],
            ]);

        $contents = (string) $response->getBody();

        if (200 !== $response->getStatusCode()) {
            throw new Logic4ApiException('Could not get access token: '.$contents);
        }

        $contents = json_decode($contents, true, 512, \JSON_THROW_ON_ERROR);

        $this->cache->set($cacheKey, $contents['access_token'], (int) $contents['expires_in']);

        return $contents['access_token'];
    }

    private function makeScope(): string
    {
        return 'api administration.'.$this->administrationId;
    }

    private function makeClientId(): string
    {
        return implode(' ', [$this->publicKey, $this->companyKey, $this->getEncodedUsername()]);
    }

    private function makeClientSecret(): string
    {
        return implode(' ', [$this->secretKey, $this->password]);
    }

    protected function getEncodedUsername(): string
    {
        return str_replace(['_', ' '], ['__', '_'], $this->username);
    }
}
