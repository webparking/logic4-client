<?php

declare(strict_types=1);

use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Webparking\Logic4Client\Generator\Generator;

require_once __DIR__.'/vendor/autoload.php';

Debug::enable();
ErrorHandler::register();

$refresh = in_array('--refresh', $argv ?? [], true);

$versions = array_filter(
    Generator::resolveVersions(),
    static fn (string $version): bool => Generator::GENERATED_MAJOR_VERSION === explode('.', $version, 2)[0],
    \ARRAY_FILTER_USE_KEY
);

foreach ($versions as $version => $url) {
    echo "Generating API namespace $version...\n";

    $generator = new Generator();
    $generator->setRefresh($refresh);
    $generator->generate($version, $url);
}

echo 'API classes generated at '.now()->toDateTimeString()."...\n";
