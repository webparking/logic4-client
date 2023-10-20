<?php

declare(strict_types=1);

namespace Webparking\Logic4Client;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class ClientFactory
{
    /** @param array<string, mixed> $options */
    public function __construct(
        private readonly string $baseUrl,
        private readonly AccessTokenManager $tokenManager,
        private readonly array $options = [],
    ) {
    }

    public function make(): Client
    {
        $handlerStack = HandlerStack::create();
        $handlerStack->push(Middleware::mapRequest(function ($request) {
            $accessToken = $this->tokenManager->getAccessToken();

            return $request->withHeader('Authorization', "Bearer {$accessToken}");
        }));

        return new Client([
            'base_uri' => $this->baseUrl,
            ...$this->options,
            'timeout' => 60,
            'handler' => $handlerStack,
        ]);
    }
}
