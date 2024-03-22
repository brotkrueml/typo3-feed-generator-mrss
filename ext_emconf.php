<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'mRSS extension for Feed Generator',
    'description' => 'Add-on for Feed Generator which provides the mRSS extension',
    'category' => 'fe',
    'author' => 'Chris Müller',
    'author_email' => 'typo3@krue.ml',
    'state' => 'beta',
    'version' => '0.3.0',
    'constraints' => [
        'depends' => [
            'feed_generator' => '0.7.0-0.7.99',
            'php' => '8.1.0-0.0.0',
            'typo3' => '12.4.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => ['Brotkrueml\\FeedGeneratorMrss\\' => 'Classes']
    ],
];
