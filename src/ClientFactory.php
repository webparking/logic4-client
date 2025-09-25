<?php

declare(strict_types=1);

namespace Webparking\Logic4Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Webparking\Logic4Client\Exceptions\Logic4ApiException;

class ClientFactory
{
    private HandlerStack $handlerStack;

    private static bool $preventStrayRequests = false;

    /** @param array<string, mixed> $options */
    public function __construct(
        private readonly AccessTokenManager $tokenManager,
        private readonly array $options = [],
        private readonly string $baseUrl = 'https://api.logic4server.nl',
    ) {
        $this->setHandlerStack(HandlerStack::create());
    }

    public static function preventStrayRequests(bool $prevent = true): void
    {
        self::$preventStrayRequests = $prevent;
    }

    public function make(): Client
    {
        if (self::$preventStrayRequests) {
            $this->handlerStack->unshift(Middleware::mapRequest(static function (): void {
                throw new \RuntimeException('Attempting to make a request while stray requests are prevented.');
            }));
        }

        return new Client([
            'base_uri' => $this->baseUrl,
            ...$this->options,
            'timeout' => 60,
            'handler' => $this->handlerStack,
        ]);
    }

    public function setHandlerStack(HandlerStack $handlerStack): self
    {
        $this->handlerStack = $handlerStack;

        $tokenManager = $this->tokenManager;

        $this->handlerStack->push(Middleware::mapRequest(static function ($request) use ($tokenManager) {
            $accessToken = $tokenManager->getAccessToken();

            return $request->withHeader('Authorization', "Bearer {$accessToken}");
        }));

        $this->handlerStack->push($this->makeRequestExceptionMiddleware());

        return $this;
    }

    private function makeRequestExceptionMiddleware(): \Closure
    {
        return static fn (callable $handler): callable => static fn (RequestInterface $request, array $options) => $handler($request, $options)->then(function (ResponseInterface $response) use ($request): ResponseInterface {
            if ($response->getStatusCode() >= 400) {
                $previous = RequestException::create($request, $response);

                throw new Logic4ApiException(message: $previous->getMessage(), code: $previous->getCode(), previous: $previous);
            }

            return $response;
        });
    }
}
