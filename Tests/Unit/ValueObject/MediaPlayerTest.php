<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\ValueObject;

use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaPlayer;
use PHPUnit\Framework\TestCase;

final class MediaPlayerTest extends TestCase
{
    /**
     * @test
     */
    public function onlyRequiredArgumentIsGiven(): void
    {
        $subject = new MediaPlayer('https://example.org/player?id=1111');

        self::assertSame('https://example.org/player?id=1111', $subject->getUrl());
        self::assertSame(0, $subject->getHeight());
        self::assertSame(0, $subject->getWidth());
    }

    /**
     * @test
     */
    public function allArgumentsAreGiven(): void
    {
        $subject = new MediaPlayer('https://example.org/player?id=1111', 200, 400);

        self::assertSame(200, $subject->getHeight());
        self::assertSame(400, $subject->getWidth());
    }
}
