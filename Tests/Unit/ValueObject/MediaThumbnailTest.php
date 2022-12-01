<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\ValueObject;

use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaThumbnail;
use PHPUnit\Framework\TestCase;

final class MediaThumbnailTest extends TestCase
{
    /**
     * @test
     */
    public function onlyRequiredArgumentIsGiven(): void
    {
        $subject = new MediaThumbnail('https://example.org/some-thumbnail');

        self::assertSame('https://example.org/some-thumbnail', $subject->getUrl());
        self::assertSame(0, $subject->getHeight());
        self::assertSame(0, $subject->getWidth());
        self::assertSame('', $subject->getTime());
    }

    /**
     * @test
     */
    public function allArgumentsAreGiven(): void
    {
        $subject = new MediaThumbnail(
            'https://example.org/some-thumbnail',
            50,
            75,
            '12:05:01.123',
        );

        self::assertSame(50, $subject->getHeight());
        self::assertSame(75, $subject->getWidth());
        self::assertSame('12:05:01.123', $subject->getTime());
    }
}
