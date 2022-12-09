<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\ValueObject;

use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaRating;
use PHPUnit\Framework\TestCase;

final class MediaRatingTest extends TestCase
{
    /**
     * @test
     */
    public function onlyRequiredArgumentIsGiven(): void
    {
        $subject = new MediaRating('r (cz 1 lz 1 nz 1 oz 1 vz 1)');

        self::assertSame('r (cz 1 lz 1 nz 1 oz 1 vz 1)', $subject->getAudience());
        self::assertSame('', $subject->getScheme());
    }

    /**
     * @test
     */
    public function allArgumentsAreGiven(): void
    {
        $subject = new MediaRating('r (cz 1 lz 1 nz 1 oz 1 vz 1)', 'urn:icra');

        self::assertSame('urn:icra', $subject->getScheme());
    }
}
