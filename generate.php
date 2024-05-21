<?php

declare(strict_types=1);

use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;

require_once __DIR__.'/vendor/autoload.php';

Debug::enable();
ErrorHandler::register();

$versions = ['1.0', '1.1', '1.2', '1.3', '2.0'];

$refresh = in_array('--refresh', $argv ?? [], true);

$setupHasRun = false;

foreach ($versions as $version) {
    echo "Generating API namespace $version...\n";

    $generator = new Webparking\Logic4Client\Generator\Generator();
    $generator->setRefresh($refresh);
    $generator->generate($version);
}

echo 'API classes generated at '.now()->toDateTimeString()."...\n";
