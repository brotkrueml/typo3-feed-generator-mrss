<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'mRSS extension for Feed Generator',
    'description' => 'Add-on for Feed Generator which provides the mRSS extension',
    'category' => 'fe',
    'author' => 'Chris Müller',
    'author_email' => 'typo3@krue.ml',
    'state' => 'beta',
    'version' => '0.2.0-dev',
    'constraints' => [
        'depends' => [
            'feed_generator' => '0.6.0-0.6.99',
            'php' => '8.1.0-0.0.0',
            'typo3' => '11.5.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => ['Brotkrueml\\FeedGeneratorMrss\\' => 'Classes']
    ],
];
