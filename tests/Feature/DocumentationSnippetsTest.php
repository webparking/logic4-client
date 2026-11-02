<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Tests\Feature;

use Webparking\Logic4Client\Tests\TestCase;

final class DocumentationSnippetsTest extends TestCase
{
    public function testEveryPhpSnippetInTheDocumentationParses(): void
    {
        $root = \dirname(__DIR__, 2);
        $failures = [];
        $snippets = 0;

        foreach ($this->documentationFiles($root) as $file) {
            $contents = file_get_contents($file);

            static::assertIsString($contents);

            preg_match_all('/```php\n(.*?)```/s', $contents, $matches);

            foreach ($matches[1] as $index => $snippet) {
                ++$snippets;

                try {
                    static::assertNotSame([], token_get_all($this->makeParsable($snippet), \TOKEN_PARSE));
                } catch (\ParseError $error) {
                    $failures[] = \sprintf('%s, snippet %d: %s', substr($file, \strlen($root) + 1), $index + 1, $error->getMessage());
                }
            }
        }

        static::assertGreaterThan(0, $snippets);
        static::assertSame([], $failures);
    }

    /** @return list<string> */
    private function documentationFiles(string $root): array
    {
        return [
            ...(glob($root.'/*.md') ?: []),
            ...(glob($root.'/docs/*.md') ?: []),
        ];
    }

    private function makeParsable(string $snippet): string
    {
        return str_starts_with(ltrim($snippet), '<?php') ? $snippet : "<?php\n".$snippet;
    }
}
