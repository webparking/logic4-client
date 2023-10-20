<?php

declare(strict_types=1);

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PSR12' => true,
        '@PHP81Migration' => true,
        '@PHP80Migration:risky' => true,
        '@PHPUnit84Migration:risky' => true,
        'ordered_imports' => true,
        'phpdoc_line_span' => [
            'const' => 'single',
            'method' => 'single',
            'property' => 'single',
        ],
        'php_unit_test_case_static_method_calls' => true,
        'phpdoc_to_comment' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in([
                __DIR__,
            ])
            ->exclude([
                'bootstrap/cache',
                'storage',
            ])
            ->ignoreUnreadableDirs()
    );
