<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\ValueObject;

use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaCategory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MediaCategoryTest extends TestCase
{
    #[Test]
    public function onlyRequiredArgumentIsGiven(): void
    {
        $subject = new MediaCategory('Arts/Movies/Titles/A/Ace_Ventura_Series/Ace_Ventura_ -_Pet_Detective');

        self::assertSame('Arts/Movies/Titles/A/Ace_Ventura_Series/Ace_Ventura_ -_Pet_Detective', $subject->getTaxonomy());
        self::assertSame('', $subject->getScheme());
        self::assertSame('', $subject->getLabel());
    }

    #[Test]
    public function allArgumentsAreGiven(): void
    {
        $subject = new MediaCategory(
            'Arts/Movies/Titles/A/Ace_Ventura_Series/Ace_Ventura_ -_Pet_Detective',
            'http://dmoz.org',
            'Ace Ventura - Pet Detective',
        );

        self::assertSame('http://dmoz.org', $subject->getScheme());
        self::assertSame('Ace Ventura - Pet Detective', $subject->getLabel());
    }
}
