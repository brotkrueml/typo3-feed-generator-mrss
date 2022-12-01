<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\Renderer;

use Brotkrueml\FeedGeneratorMrss\Renderer\MissingRequiredPropertyException;
use PHPUnit\Framework\TestCase;

final class MissingRequiredPropertyExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function forProperty(): void
    {
        $actual = MissingRequiredPropertyException::forElement('some/property');

        self::assertSame('Required property "some/property" is missing.', $actual->getMessage());
        self::assertSame(1669905387, $actual->getCode());
    }
}
