<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use Webparking\Logic4Client\Generator\EndpointDocumentationGenerator;
use Webparking\Logic4Client\Generator\Helpers;
use Webparking\Logic4Client\Tests\TestCase;

final class EndpointDocumentationGeneratorTest extends TestCase
{
    private string $outputDirectory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->outputDirectory = sys_get_temp_dir().'/logic4-endpoint-docs-'.uniqid();
    }

    protected function tearDown(): void
    {
        Helpers::emptyDirectory($this->outputDirectory);

        parent::tearDown();
    }

    public function testRendersAnIndexAndOnePageForEveryVersionNamespace(): void
    {
        $rendered = $this->makeGenerator()->render();

        $expectedPages = array_map(
            static fn (string $directory): string => basename($directory).'.md',
            glob($this->requestsDirectory().'/V*') ?: [],
        );

        static::assertSame(['README.md', ...$expectedPages], array_keys($rendered));
        static::assertStringContainsString('| [`V10`](V10.md) | v1.0 | `/v1/` | 29 | 267 | 50 |', $rendered['README.md']);
        static::assertStringContainsString('| [`V11`](V11.md) | v1.1 | `/v1.1/` | 13 | 79 | 11 |', $rendered['README.md']);
        static::assertStringContainsString('# Logic4 API v3.0 endpoints (`V30`)', $rendered['V30.md']);
        static::assertStringContainsString('`POST /v3/', $rendered['V30.md']);
        static::assertStringContainsString('| `void` |', $rendered['V30.md']);
    }

    public function testDescribesRouteReturnTypeAndDeprecationOfFrozenEndpoints(): void
    {
        $rendered = $this->makeGenerator()->render();

        static::assertStringContainsString(
            '| `getProductGroups(array $parameters = [])` | `POST /v1/ProductGroups/GetProductGroups` | `ProductGroupLogic4ResponseList` | Deprecated |',
            $rendered['V10.md'],
        );
        static::assertStringContainsString(
            '| `getProductGroupTypes()` | `GET /v1/ProductGroups/GetProductGroupTypes` | `ProductGroupTypeLogic4ResponseList` |  |',
            $rendered['V10.md'],
        );
        static::assertStringContainsString(
            '| `deleteRound(int $roundId)` | `DELETE /v1/Round/DeleteRound` | `BooleanLogic4Response` |  |',
            $rendered['V10.md'],
        );
        static::assertStringContainsString(
            '| `getProducts(array $parameters = [])` | `POST /v1.1/Products/GetProducts` | `Generator<ProductV11>` |',
            $rendered['V11.md'],
        );
        static::assertStringContainsString(
            '| `getSuppliersForProduct(int $value)` | `POST /v1.1/Products/GetSuppliersForProduct` |',
            $rendered['V11.md'],
        );
        static::assertStringContainsString('- [ProductGroupsRequest](#productgroupsrequest) (2)', $rendered['V10.md']);
    }

    public function testWritesPagesAndReportsMissingStaleAndUnexpectedFiles(): void
    {
        $generator = $this->makeGenerator();

        static::assertNotSame([], $generator->check());

        $written = $generator->write();

        static::assertSame($this->outputDirectory.'/README.md', $written[0]);
        static::assertFileExists($this->outputDirectory.'/V10.md');
        static::assertSame([], $generator->check());

        file_put_contents($this->outputDirectory.'/V10.md', 'stale');
        file_put_contents($this->outputDirectory.'/V99.md', 'unexpected');

        static::assertSame([
            $this->outputDirectory.'/V10.md',
            $this->outputDirectory.'/V99.md',
        ], $generator->check());
    }

    private function makeGenerator(): EndpointDocumentationGenerator
    {
        return new EndpointDocumentationGenerator($this->requestsDirectory(), $this->outputDirectory);
    }

    private function requestsDirectory(): string
    {
        return \dirname(__DIR__, 2).'/src/Requests';
    }
}
