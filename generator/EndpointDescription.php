<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

final readonly class EndpointDescription
{
    public function __construct(
        public string $requestClass,
        public string $signature,
        public string $httpMethod,
        public string $uri,
        public string $returnType,
        public bool $deprecated,
    ) {
    }
}
