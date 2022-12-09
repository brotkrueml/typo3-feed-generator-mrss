<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\Renderer;

use Brotkrueml\FeedGeneratorMrss\Renderer\WrongAudienceInRatingException;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaRating;
use PHPUnit\Framework\TestCase;

final class WrongAudienceInRatingExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function forRating(): void
    {
        $actual = WrongAudienceInRatingException::forRating(new MediaRating('some rating'));

        self::assertSame(
            'Scheme with "urn:simple" only allows "adult" or "nonadult" as value, "some rating" given.',
            $actual->getMessage()
        );
        self::assertSame(1670589654, $actual->getCode());
    }
}
