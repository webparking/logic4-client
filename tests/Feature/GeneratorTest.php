<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use Webparking\Logic4Client\Generator\ApiDocumentationSource;
use Webparking\Logic4Client\Generator\Generator;
use Webparking\Logic4Client\Tests\TestCase;

final class GeneratorTest extends TestCase
{
    public function testCanDetectProductionApiVersions(): void
    {
        $generator = new Generator(ApiDocumentationSource::Production);

        static::assertSame([
            '1.0' => 'https://api.logic4server.nl/openapi/v1.json',
            '3.0' => 'https://api.logic4server.nl/openapi/v3.json',
            '3.1' => 'https://api.logic4server.nl/openapi/v3.1.json',
        ], $generator->resolveVersionsFromScalar($this->scalarFixture()));
    }

    public function testCanDetectQaApiVersions(): void
    {
        $generator = new Generator(ApiDocumentationSource::Qa);

        static::assertSame([
            '1.0' => 'https://qa.api.logic4server.nl/openapi/v1.json',
            '3.0' => 'https://qa.api.logic4server.nl/openapi/v3.json',
            '3.1' => 'https://qa.api.logic4server.nl/openapi/v3.1.json',
        ], $generator->resolveVersionsFromScalar($this->scalarFixture()));
    }

    public function testRejectsApiDocumentationOutsideTheSelectedEnvironment(): void
    {
        $generator = new Generator(ApiDocumentationSource::Qa);

        $this->expectExceptionMessage('does not match the expected pattern');

        $generator->resolveVersionsFromScalar(str_replace(
            'openapi/v3.json',
            'https://example.com/openapi/v3.json',
            $this->scalarFixture(),
        ));
    }

    private function scalarFixture(): string
    {
        $contents = file_get_contents(__DIR__.'/../Fixtures/scalar.html');

        static::assertIsString($contents);

        return $contents;
    }
}
