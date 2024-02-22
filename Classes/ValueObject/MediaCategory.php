<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\ValueObject;

final class MediaCategory
{
    public function __construct(
        private readonly string $taxonomy,
        private readonly string $scheme = '',
        private readonly string $label = '',
    ) {}

    public function getTaxonomy(): string
    {
        return $this->taxonomy;
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
