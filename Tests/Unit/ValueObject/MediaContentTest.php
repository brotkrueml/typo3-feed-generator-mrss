<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\ValueObject;

use Brotkrueml\FeedGeneratorMrss\Enumeration\Expression;
use Brotkrueml\FeedGeneratorMrss\Enumeration\Medium;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaPlayer;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaRating;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaThumbnail;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent
 */
final class MediaContentTest extends TestCase
{
    private MediaContent $subject;

    protected function setUp(): void
    {
        $this->subject = new MediaContent();
    }

    /**
     * @test
     */
    public function propertiesAreInitialisedCorrectly(): void
    {
        self::assertSame(0, $this->subject->getBitrate());
        self::assertSame(0, $this->subject->getChannels());
        self::assertSame(0, $this->subject->getDuration());
        self::assertNull($this->subject->getExpression());
        self::assertSame(0, $this->subject->getFileSize());
        self::assertSame(0, $this->subject->getFramerate());
        self::assertSame(0, $this->subject->getHeight());
        self::assertFalse($this->subject->getIsDefault());
        self::assertSame('', $this->subject->getLang());
        self::assertNull($this->subject->getMedium());
        self::assertNull($this->subject->getPlayer());
        self::assertSame('', $this->subject->getSamplingrate());
        self::assertSame('', $this->subject->getType());
        self::assertSame('', $this->subject->getUrl());
        self::assertSame(0, $this->subject->getWidth());

        self::assertSame('', $this->subject->getDescription());
        self::assertSame('', $this->subject->getKeywords());
        self::assertSame('', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getAndSetBitrate(): void
    {
        $actual = $this->subject->setBitrate(128);

        self::assertSame($this->subject, $actual);
        self::assertSame(128, $this->subject->getBitrate());
    }

    /**
     * @test
     */
    public function getAndSetChannels(): void
    {
        $actual = $this->subject->setChannels(2);

        self::assertSame($this->subject, $actual);
        self::assertSame(2, $this->subject->getChannels());
    }

    /**
     * @test
     */
    public function getAndSetDuration(): void
    {
        $actual = $this->subject->setDuration(185);

        self::assertSame($this->subject, $actual);
        self::assertSame(185, $this->subject->getDuration());
    }

    /**
     * @test
     */
    public function getAndSetExpression(): void
    {
        $actual = $this->subject->setExpression(Expression::Full);

        self::assertSame($this->subject, $actual);
        self::assertSame(Expression::Full, $this->subject->getExpression());
    }

    /**
     * @test
     */
    public function getAndSetFileSize(): void
    {
        $actual = $this->subject->setFileSize(12216320);

        self::assertSame($this->subject, $actual);
        self::assertSame(12216320, $this->subject->getFileSize());
    }

    /**
     * @test
     */
    public function getAndSetFramerate(): void
    {
        $actual = $this->subject->setFramerate(25);

        self::assertSame($this->subject, $actual);
        self::assertSame(25, $this->subject->getFramerate());
    }

    /**
     * @test
     */
    public function getAndSetHeight(): void
    {
        $actual = $this->subject->setHeight(200);

        self::assertSame($this->subject, $actual);
        self::assertSame(200, $this->subject->getHeight());
    }

    /**
     * @test
     */
    public function getAndSetIsDefault(): void
    {
        $actual = $this->subject->setIsDefault(true);

        self::assertSame($this->subject, $actual);
        self::assertTrue($this->subject->getIsDefault());
    }

    /**
     * @test
     */
    public function getAndSetLang(): void
    {
        $actual = $this->subject->setLang('en');

        self::assertSame($this->subject, $actual);
        self::assertSame('en', $this->subject->getLang());
    }

    /**
     * @test
     */
    public function getAndSetMedium(): void
    {
        $actual = $this->subject->setMedium(Medium::Video);

        self::assertSame($this->subject, $actual);
        self::assertSame(Medium::Video, $this->subject->getMedium());
    }

    /**
     * @test
     */
    public function getAndSetPlayer(): void
    {
        $player = new MediaPlayer('https://example.org/player?id=1111');

        $actual = $this->subject->setPlayer($player);

        self::assertSame($this->subject, $actual);
        self::assertSame($player, $this->subject->getPlayer());
    }

    /**
     * @test
     */
    public function getAndSetRating(): void
    {
        $rating = new MediaRating('adult');

        $actual = $this->subject->setRating($rating);

        self::assertSame($this->subject, $actual);
        self::assertSame($rating, $this->subject->getRating());
    }

    /**
     * @test
     */
    public function getAndSetSamplingrate(): void
    {
        $actual = $this->subject->setSamplingrate('44.1');

        self::assertSame($this->subject, $actual);
        self::assertSame('44.1', $this->subject->getSamplingrate());
    }

    /**
     * @test
     */
    public function getAndSetType(): void
    {
        $actual = $this->subject->setType('video/quicktime');

        self::assertSame($this->subject, $actual);
        self::assertSame('video/quicktime', $this->subject->getType());
    }

    /**
     * @test
     */
    public function getAndSetUrl(): void
    {
        $actual = $this->subject->setUrl('http://www.foo.com/movie.mov');

        self::assertSame($this->subject, $actual);
        self::assertSame('http://www.foo.com/movie.mov', $this->subject->getUrl());
    }

    /**
     * @test
     */
    public function getAndSetWidth(): void
    {
        $actual = $this->subject->setWidth(300);

        self::assertSame($this->subject, $actual);
        self::assertSame(300, $this->subject->getWidth());
    }

    /**
     * @test
     */
    public function getAndSetDescription(): void
    {
        $actual = $this->subject->setDescription('This was some really bizarre band I listened to as a young lad.');

        self::assertSame($this->subject, $actual);
        self::assertSame('This was some really bizarre band I listened to as a young lad.', $this->subject->getDescription());
    }

    /**
     * @test
     */
    public function getAndSetKeywords(): void
    {
        $actual = $this->subject->setKeywords('kitty, cat, big dog, yarn, fluffy');

        self::assertSame($this->subject, $actual);
        self::assertSame('kitty, cat, big dog, yarn, fluffy', $this->subject->getKeywords());
    }

    /**
     * @test
     */
    public function getAndAddThumbnail(): void
    {
        $thumbnail1 = new MediaThumbnail('https://example.org/some-thumbnail');
        $thumbnail2 = new MediaThumbnail('https://example.org/another-thumbnail');

        $actual = $this->subject->addThumbnails($thumbnail1, $thumbnail2);

        self::assertSame($this->subject, $actual);
        self::assertCount(2, $this->subject->getThumbnails());
        self::assertContains($thumbnail1, $this->subject->getThumbnails());
        self::assertContains($thumbnail2, $this->subject->getThumbnails());

        $thumbnail3 = new MediaThumbnail('https://example.org/one-more-thumbnail');

        $this->subject->addThumbnails($thumbnail3);

        self::assertCount(3, $this->subject->getThumbnails());
        self::assertContains($thumbnail3, $this->subject->getThumbnails());
    }

    /**
     * @test
     */
    public function getAndSetTitle(): void
    {
        $actual = $this->subject->setTitle('The Judy\'s -- The Moo Song');

        self::assertSame($this->subject, $actual);
        self::assertSame('The Judy\'s -- The Moo Song', $this->subject->getTitle());
    }
}
