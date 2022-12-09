<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

$classes = [
    \Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent::class => 'Classes/MediaContent.rst',
    \Brotkrueml\FeedGeneratorMrss\ValueObject\MediaPlayer::class => 'Classes/MediaPlayer.rst',
    \Brotkrueml\FeedGeneratorMrss\ValueObject\MediaRating::class => 'Classes/MediaRating.rst',
    \Brotkrueml\FeedGeneratorMrss\ValueObject\MediaThumbnail::class => 'Classes/MediaThumbnail.rst',

    \Brotkrueml\FeedGeneratorMrss\Enumeration\Expression::class => 'Enums/Expression.rst',
    \Brotkrueml\FeedGeneratorMrss\Enumeration\Medium::class => 'Enums/Medium.rst',
];

$template = <<<TEMPLATE

================================================================================
%s
================================================================================

%s

TEMPLATE;

$result = [];
foreach ($classes as $class => $filePath) {
    $result[] = [
        'action' => 'createPhpClassDocs',
        'class' => $class,
        'targetFileName' => '../API/' . $filePath,
        'template' => $template,
    ];
}

return $result;
