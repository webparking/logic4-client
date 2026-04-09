<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use Webparking\Logic4Client\Generator\Generator;
use Webparking\Logic4Client\Tests\TestCase;

final class GeneratorTest extends TestCase
{
    public function testCanDetectApiVersions(): void
    {
        $versions = Generator::resolveVersions();

        static::assertNotEmpty($versions);

        foreach ($versions as $version => $url) {
            static::assertMatchesRegularExpression('/^\d+\.\d+$/', $version);
            static::assertStringStartsWith('https://api.logic4server.nl/openapi/', $url);
        }
    }
}
