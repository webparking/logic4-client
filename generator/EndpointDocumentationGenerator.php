<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Generator;

use Webmozart\Assert\Assert;

final class EndpointDocumentationGenerator
{
    private const string INDEX_FILE = 'README.md';
    private const string GENERATE_COMMAND = 'composer generate-endpoint-docs';
    private const string DEPRECATED_MARKER = 'Deprecated';

    public function __construct(
        private readonly string $requestsDirectory,
        private readonly string $outputDirectory,
        private readonly string $baseNamespace = 'Webparking\Logic4Client',
    ) {
    }

    /** @return array<string, string> file name => contents */
    public function render(): array
    {
        $versions = $this->collect();
        $files = [self::INDEX_FILE => $this->renderIndex($versions)];

        foreach ($versions as $version => $endpoints) {
            $files[$version.'.md'] = $this->renderVersion($version, $endpoints);
        }

        return $files;
    }

    /** @return list<string> */
    public function write(): array
    {
        Helpers::createDirectory($this->outputDirectory);
        Helpers::emptyDirectory($this->outputDirectory, []);

        $written = [];
        foreach ($this->render() as $file => $contents) {
            $path = $this->outputDirectory.'/'.$file;

            file_put_contents($path, $contents);

            $written[] = $path;
        }

        return $written;
    }

    /** @return list<string> */
    public function check(): array
    {
        $rendered = $this->render();
        $stale = [];

        foreach ($rendered as $file => $contents) {
            $path = $this->outputDirectory.'/'.$file;

            if (!is_file($path) || file_get_contents($path) !== $contents) {
                $stale[] = $path;
            }
        }

        foreach (glob($this->outputDirectory.'/*.md') ?: [] as $existing) {
            if (!\array_key_exists(basename($existing), $rendered)) {
                $stale[] = $existing;
            }
        }

        return $stale;
    }

    /** @return array<string, list<EndpointDescription>> version => endpoints */
    public function collect(): array
    {
        $versions = [];

        foreach (glob($this->requestsDirectory.'/V*/*Request.php') ?: [] as $file) {
            $version = basename(\dirname($file));

            Assert::regex($version, '/^V\d\d$/', 'Unexpected request namespace directory %s');

            foreach ($this->describeClass($version, basename($file, '.php'), $file) as $endpoint) {
                $versions[$version][] = $endpoint;
            }
        }

        ksort($versions);

        return $versions;
    }

    /** @return list<EndpointDescription> */
    private function describeClass(string $version, string $className, string $file): array
    {
        $fqcn = \sprintf('%s\Requests\%s\%s', $this->baseNamespace, $version, $className);

        Assert::classExists($fqcn);

        $source = file_get_contents($file);

        Assert::string($source);

        $lines = explode("\n", $source);
        $endpoints = [];

        foreach ((new \ReflectionClass($fqcn))->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() !== $fqcn) {
                continue;
            }

            $startLine = $method->getStartLine();
            $endLine = $method->getEndLine();

            Assert::integer($startLine);
            Assert::integer($endLine);

            $body = implode("\n", \array_slice($lines, $startLine - 1, $endLine - $startLine + 1));
            $docComment = $method->getDocComment() ?: '';
            [$httpMethod, $uri] = $this->resolveRoute($body, $fqcn.'::'.$method->getName());

            $endpoints[] = new EndpointDescription(
                requestClass: $className,
                signature: $this->signature($method),
                httpMethod: $httpMethod,
                uri: $uri,
                returnType: $this->returnType($method, $docComment),
                deprecated: str_contains($docComment, '@deprecated'),
            );
        }

        usort($endpoints, static fn (EndpointDescription $left, EndpointDescription $right): int => strcmp($left->signature, $right->signature));

        return $endpoints;
    }

    /** @return array{string, string} */
    private function resolveRoute(string $body, string $method): array
    {
        if (1 === preg_match('/->(get|post|put|patch|delete)\(\s*\'([^\']+)\'/', $body, $matches)) {
            return [strtoupper($matches[1]), $matches[2]];
        }

        if (1 === preg_match('/paginateRecords\(\s*\'([^\']+)\'/', $body, $matches)) {
            return ['POST', $matches[1]];
        }

        throw new \RuntimeException(\sprintf('Could not determine the HTTP route of %s', $method));
    }

    private function signature(\ReflectionMethod $method): string
    {
        $parameters = [];
        foreach ($method->getParameters() as $parameter) {
            $type = $parameter->getType();
            $definition = (null === $type ? '' : $type.' ').'$'.$parameter->getName();

            if ($parameter->isDefaultValueAvailable()) {
                $definition .= ' = '.$this->exportDefault($parameter->getDefaultValue());
            }

            $parameters[] = $definition;
        }

        return \sprintf('%s(%s)', $method->getName(), implode(', ', $parameters));
    }

    private function exportDefault(mixed $value): string
    {
        return match (true) {
            [] === $value => '[]',
            default => var_export($value, true),
        };
    }

    private function returnType(\ReflectionMethod $method, string $docComment): string
    {
        if (1 === preg_match('/@return\s+\\\\?(Generator|array)<array-key,\s*\\\\?([\w\\\\]+)>/', $docComment, $matches)) {
            return \sprintf('%s<%s>', $matches[1], $this->shortName($matches[2]));
        }

        return $this->shortName((string) $method->getReturnType());
    }

    private function shortName(string $type): string
    {
        $nullable = str_starts_with($type, '?');
        $segments = explode('\\', ltrim($type, '?\\'));

        return ($nullable ? '?' : '').end($segments);
    }

    /** @param array<string, list<EndpointDescription>> $versions */
    private function renderIndex(array $versions): string
    {
        $lines = [
            '# Endpoint reference',
            '',
            \sprintf('One page per Logic4 API version namespace, generated from `src/Requests` by `%s`. Do not edit by hand. See [Choosing an API version](../api-versions.md) for what the namespaces mean.', self::GENERATE_COMMAND),
            '',
            '| Namespace | Logic4 API | URL prefix | Request classes | Endpoints | Deprecated |',
            '| --- | --- | --- | --- | --- | --- |',
        ];

        foreach ($versions as $version => $endpoints) {
            $lines[] = \sprintf(
                '| [`%s`](%s.md) | %s | `%s` | %d | %d | %d |',
                $version,
                $version,
                $this->apiVersion($version),
                $this->urlPrefix($endpoints),
                \count($this->groupByClass($endpoints)),
                \count($endpoints),
                $this->countDeprecated($endpoints),
            );
        }

        return implode("\n", $lines)."\n";
    }

    /** @param list<EndpointDescription> $endpoints */
    private function renderVersion(string $version, array $endpoints): string
    {
        $classes = $this->groupByClass($endpoints);

        $lines = [
            \sprintf('# Logic4 API %s endpoints (`%s`)', $this->apiVersion($version), $version),
            '',
            \sprintf('Generated from `src/Requests/%s` by `%s`. Do not edit by hand. See [Choosing an API version](../api-versions.md) for what the namespaces mean, and Logic4\'s own documentation for parameters and descriptions.', $version, self::GENERATE_COMMAND),
            '',
            \sprintf(
                'Namespace `%s\Requests\%s` · %d request classes · %d endpoints · %d deprecated',
                $this->baseNamespace,
                $version,
                \count($classes),
                \count($endpoints),
                $this->countDeprecated($endpoints),
            ),
            '',
        ];

        foreach ($classes as $class => $classEndpoints) {
            $lines[] = \sprintf('- [%s](#%s) (%d)', $class, strtolower($class), \count($classEndpoints));
        }

        foreach ($classes as $class => $classEndpoints) {
            $lines[] = '';
            $lines[] = '## '.$class;
            $lines[] = '';
            $lines[] = '| Method | HTTP | Returns | Status |';
            $lines[] = '| --- | --- | --- | --- |';

            foreach ($classEndpoints as $endpoint) {
                $lines[] = \sprintf(
                    '| `%s` | `%s %s` | `%s` | %s |',
                    $endpoint->signature,
                    $endpoint->httpMethod,
                    $endpoint->uri,
                    $endpoint->returnType,
                    $endpoint->deprecated ? self::DEPRECATED_MARKER : '',
                );
            }
        }

        return implode("\n", $lines)."\n";
    }

    /**
     * @param list<EndpointDescription> $endpoints
     *
     * @return array<string, list<EndpointDescription>>
     */
    private function groupByClass(array $endpoints): array
    {
        $grouped = [];
        foreach ($endpoints as $endpoint) {
            $grouped[$endpoint->requestClass][] = $endpoint;
        }

        ksort($grouped);

        return $grouped;
    }

    /** @param list<EndpointDescription> $endpoints */
    private function countDeprecated(array $endpoints): int
    {
        return \count(array_filter($endpoints, static fn (EndpointDescription $endpoint): bool => $endpoint->deprecated));
    }

    /** @param list<EndpointDescription> $endpoints */
    private function urlPrefix(array $endpoints): string
    {
        $prefixes = [];
        foreach ($endpoints as $endpoint) {
            $prefixes['/'.explode('/', ltrim($endpoint->uri, '/'))[0].'/'] = true;
        }

        return implode(', ', array_keys($prefixes));
    }

    private function apiVersion(string $version): string
    {
        return \sprintf('v%s.%s', $version[1], $version[2]);
    }
}
