<?php

$excluded_folders = [
    'vendor',
];
$finder = PhpCsFixer\Finder::create()
    ->exclude($excluded_folders)
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2'                             => true,
        '@Symfony'                          => true,
        'binary_operator_spaces'            => ['align_double_arrow' => true],
        'linebreak_after_opening_tag'       => true,
        'not_operator_with_successor_space' => true,
        'ordered_imports'                   => [
            'sortAlgorithm' => 'length',
        ],
        'phpdoc_order'      => true,
        'no_unused_imports' => true,
        'array_syntax'      => [
            'syntax' => 'short',
        ],
    ])
    ->setFinder($finder);
