<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

use Webmozart\Assert\Assert;

enum ApiDocumentationSource: string
{
    case Production = 'production';
    case Qa = 'qa';

    public function scalarUrl(): string
    {
        return $this->baseUrl().'scalar/';
    }

    public function openApiUrl(string $path): string
    {
        Assert::regex($path, '/\Aopenapi\/[a-z0-9]+(?:\.[a-z0-9]+)*\.json\z/D');

        return $this->baseUrl().$path;
    }

    private function baseUrl(): string
    {
        return match ($this) {
            self::Production => 'https://api.logic4server.nl/',
            self::Qa => 'https://qa.api.logic4server.nl/',
        };
    }
}
