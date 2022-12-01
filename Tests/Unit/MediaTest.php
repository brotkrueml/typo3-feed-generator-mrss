<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit;

use Brotkrueml\FeedGenerator\Contract\ExtensionContentInterface;
use Brotkrueml\FeedGeneratorMrss\Media;
use Brotkrueml\FeedGeneratorMrss\Renderer\MediaContentRenderer;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Brotkrueml\FeedGeneratorMrss\Media
 */
final class MediaTest extends TestCase
{
    private Media $subject;

    protected function setUp(): void
    {
        $this->subject = new Media();
    }

    /**
     * @test
     */
    public function canHandleReturnsTrueIfElementIsMediaContent(): void
    {
        $actual = $this->subject->canHandle(new MediaContent());

        self::assertTrue($actual);
    }

    /**
     * @test
     */
    public function canHandleReturnsFalseIfElementIsNotRecognised(): void
    {
        $element = new class() implements ExtensionContentInterface {
        };

        $actual = $this->subject->canHandle($element);

        self::assertFalse($actual);
    }

    /**
     * @test
     */
    public function getNamespaceReturnsCorrectNamespace(): void
    {
        $actual = $this->subject->getNamespace();

        self::assertSame('http://search.yahoo.com/mrss/', $actual);
    }

    /**
     * @test
     */
    public function getQualifiedNameReturnsCorrectName(): void
    {
        $actual = $this->subject->getQualifiedName();

        self::assertSame('media', $actual);
    }

    /**
     * @test
     */
    public function getRendererReturnsCorrectRenderer(): void
    {
        $actual = $this->subject->getXmlRenderer();

        self::assertInstanceOf(MediaContentRenderer::class, $actual);
    }
}
