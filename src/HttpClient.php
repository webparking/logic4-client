<?php

declare(strict_types=1);

namespace Webparking\Logic4Client;

use GuzzleHttp\Client;

class HttpClient
{
    private Client $client;

    public function __construct(
        private readonly ClientFactory $clientFactory,
    ) {
    }

    public function getClient(): Client
    {
        return $this->client ??= $this->clientFactory->make();
    }
}
