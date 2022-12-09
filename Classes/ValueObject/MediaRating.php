<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\ValueObject;

final class MediaRating
{
    public function __construct(
        private readonly string $audience,
        private readonly string $scheme = '',
    ) {
    }

    public function getAudience(): string
    {
        return $this->audience;
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }
}
