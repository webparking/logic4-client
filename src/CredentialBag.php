<?php

declare(strict_types=1);

namespace Webparking\Logic4Client;

final class CredentialBag
{
    public function __construct(
        public readonly string $authUrl,
        public readonly string $publicKey,
        public readonly string $companyKey,
        public readonly string $username,
        public readonly string $secretKey,
        public readonly string $password,
        public readonly string $administrationId,
    ) {
    }
}
