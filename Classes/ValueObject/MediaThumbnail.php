<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\ValueObject;

final class MediaThumbnail
{
    public function __construct(
        private readonly string $url,
        private readonly int $height = 0,
        private readonly int $width = 0,
        private readonly string $time = '',
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getTime(): string
    {
        return $this->time;
    }
}
