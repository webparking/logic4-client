<?php

declare(strict_types=1);

use Webparking\Logic4Client\Generator\EndpointDocumentationGenerator;

require_once __DIR__.'/vendor/autoload.php';

$options = getopt('', ['check']);
$generator = new EndpointDocumentationGenerator(__DIR__.'/src/Requests', __DIR__.'/docs/endpoints');

if (is_array($options) && array_key_exists('check', $options)) {
    $stale = $generator->check();

    if ([] === $stale) {
        echo "Endpoint reference is up to date.\n";

        exit(0);
    }

    fwrite(\STDERR, "Endpoint reference is out of date, run `composer generate-endpoint-docs`:\n".implode("\n", $stale)."\n");

    exit(1);
}

foreach ($generator->write() as $file) {
    echo "Wrote {$file}\n";
}
