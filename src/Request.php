<?php

declare(strict_types=1);

namespace Webparking\Logic4Client;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class Request
{
    private Client $client;

    public function __construct(
        private readonly ClientFactory $clientFactory,
    ) {
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    protected function getClient(): Client
    {
        return $this->client ??= $this->clientFactory->make();
    }

    protected function buildResponse(ResponseInterface $response): mixed
    {
        return json_decode((string) $response->getBody(), true, 512, \JSON_THROW_ON_ERROR);
    }

    /**
     * @param array<mixed> $body
     *
     * @return \Generator<array<mixed>>
     */
    protected function paginateRecords(string $uri, array $body, string $takeField = 'TakeRecords', string $skipField = 'SkipRecords'): \Generator
    {
        $body = [
            $takeField => 1000,
            $skipField => 0,
            ...$body,
        ];

        do {
            /** @var array<mixed> $response */
            $response = $this->buildResponse(
                $this->getClient()->post($uri, ['json' => $body])
            );

            foreach ($response['Records'] as $record) {
                yield $record;
            }

            $body[$skipField] += $body[$takeField];
        } while ($response['RecordsCounter'] === $body[$takeField] && $response['RecordsCounter'] > 0);
    }
}
