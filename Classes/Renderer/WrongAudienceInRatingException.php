<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Renderer;

use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaRating;

final class WrongAudienceInRatingException extends \DomainException
{
    public static function forRating(MediaRating $rating): self
    {
        return new self(
            \sprintf(
                'Scheme with "urn:simple" only allows "adult" or "nonadult" as value, "%s" given.',
                $rating->getAudience()
            ),
            1670589654
        );
    }
}
