<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Enumeration;

enum Expression: string
{
    case Full = 'full';
    case NonStop = 'nonstop';
    case Sample = 'sample';
}
