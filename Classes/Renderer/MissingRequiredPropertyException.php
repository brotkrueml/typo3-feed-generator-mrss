<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Renderer;

final class MissingRequiredPropertyException extends \DomainException
{
    public static function forElement(string $property): self
    {
        return new self(
            \sprintf(
                'Required property "%s" is missing.',
                $property
            ),
            1669905387
        );
    }
}
