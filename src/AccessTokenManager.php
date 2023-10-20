<?php

declare(strict_types=1);

namespace Webparking\Logic4Client;

use GuzzleHttp\Client;
use Psr\SimpleCache\CacheInterface;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;

class AccessTokenManager
{
    public function __construct(
        private readonly CredentialBag $credentialBag,
        private readonly CacheInterface $cache,
        private readonly Client $client = new Client(),
    ) {
    }

    public function getAccessToken(): string
    {
        $cacheKey = 'logic4_access_token';

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $response = $this->client
            ->post($this->credentialBag->authUrl, [
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
        return 'api administration.'.$this->credentialBag->administrationId;
    }

    private function makeClientId(): string
    {
        return implode(' ', [$this->credentialBag->publicKey, $this->credentialBag->companyKey, $this->getEncodedUsername()]);
    }

    private function makeClientSecret(): string
    {
        return implode(' ', [$this->credentialBag->secretKey, $this->credentialBag->password]);
    }

    protected function getEncodedUsername(): string
    {
        return str_replace(['_', ' '], ['__', '_'], $this->credentialBag->username);
    }
}
