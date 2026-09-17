<?php

declare(strict_types=1);

use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Webparking\Logic4Client\Generator\ApiDocumentationSource;
use Webparking\Logic4Client\Generator\Generator;

require_once __DIR__.'/vendor/autoload.php';

Debug::enable();
ErrorHandler::register();

$options = getopt('', ['refresh', 'source:']);

if (false === $options) {
    fwrite(\STDERR, "Could not parse generator options.\n");

    exit(1);
}

$sourceName = $options['source'] ?? ApiDocumentationSource::Production->value;

if (!is_string($sourceName) || null === ($source = ApiDocumentationSource::tryFrom($sourceName))) {
    fwrite(\STDERR, "Source must be either production or qa.\n");

    exit(1);
}

$refresh = array_key_exists('refresh', $options);
$generator = new Generator($source);

$versions = array_filter(
    $generator->resolveVersions(),
    static fn (string $version): bool => Generator::GENERATED_MAJOR_VERSION === explode('.', $version, 2)[0],
    \ARRAY_FILTER_USE_KEY
);

foreach ($versions as $version => $url) {
    echo "Generating {$source->value} API namespace $version...\n";

    $generator->setRefresh($refresh);
    $generator->generate($version, $url);
}

echo 'API classes generated at '.now()->toDateTimeString()."...\n";
