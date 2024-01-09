<?php

declare(strict_types=1);

use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;

require_once __DIR__.'/vendor/autoload.php';

Debug::enable();
ErrorHandler::register();

$generator = new Webparking\Logic4Client\Generator\Generator();
$generator->setRefresh(in_array('--refresh', $argv ?? [], true));
echo $generator->generate();
