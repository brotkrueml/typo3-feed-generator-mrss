<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\Renderer;

use Brotkrueml\FeedGeneratorMrss\Enumeration\Expression;
use Brotkrueml\FeedGeneratorMrss\Enumeration\Medium;
use Brotkrueml\FeedGeneratorMrss\Renderer\MediaContentRenderer;
use Brotkrueml\FeedGeneratorMrss\Renderer\MissingRequiredMediaContentException;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaPlayer;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaRating;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaThumbnail;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Brotkrueml\FeedGeneratorMrss\Renderer\MediaContentRenderer
 */
final class MediaContentRendererTest extends TestCase
{
    private \DOMDocument $document;
    private \DOMElement $rootElement;
    private MediaContentRenderer $subject;

    protected function setUp(): void
    {
        $this->document = new \DOMDocument('1.0', 'utf-8');
        $this->document->formatOutput = true;

        $this->rootElement = $this->document->appendChild($this->document->createElement('root'));

        $this->subject = new MediaContentRenderer();
    }

    /**
     * @test
     */
    public function neitherUrlNorPlayerIsSetInValueObject(): void
    {
        $this->expectException(MissingRequiredMediaContentException::class);
        $this->expectExceptionCode(1669902205);
        $this->expectExceptionMessage('Either url or player must be given for media content');

        $content = new MediaContent();
        $this->subject->render($content, $this->rootElement, $this->document);
    }

    /**
     * @test
     * @dataProvider provider
     */
    public function onlyUrlIsGivenInValueObject(MediaContent $content, string $expected): void
    {
        $this->subject->render($content, $this->rootElement, $this->document);

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    public function provider(): iterable
    {
        yield 'Only url is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media'),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media"/>
</root>
XML,
        ];

        yield 'Only player is given' => [
            'content' => (new MediaContent())
                ->setPlayer(new MediaPlayer('https://example.org/some-player?id=1234')),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content>
    <media:player url="https://example.org/some-player?id=1234" />
  </media:content>
</root>
XML,
        ];

        yield 'fileSize is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setFileSize(987654),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" fileSize="987654"/>
</root>
XML,
        ];

        yield 'type is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setType('some/type'),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" type="some/type"/>
</root>
XML,
        ];

        yield 'medium is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setMedium(Medium::Video),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" medium="video"/>
</root>
XML,
        ];

        yield 'isDefault is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setIsDefault(true),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" isDefault="true"/>
</root>
XML,
        ];

        yield 'expression is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setExpression(Expression::Full),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" expression="full"/>
</root>
XML,
        ];

        yield 'bitrate is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setBitrate(128),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" bitrate="128"/>
</root>
XML,
        ];

        yield 'framerate is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setFramerate(25),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" framerate="25"/>
</root>
XML,
        ];

        yield 'samplingrate is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setSamplingrate('44.1'),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" samplingrate="44.1"/>
</root>
XML,
        ];

        yield 'channels is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setChannels(2),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" channels="2"/>
</root>
XML,
        ];

        yield 'duration is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setDuration(185),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" duration="185"/>
</root>
XML,
        ];

        yield 'height is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setHeight(200),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" height="200"/>
</root>
XML,
        ];

        yield 'width is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setWidth(300),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" width="300"/>
</root>
XML,
        ];

        yield 'lang is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setLang('de'),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media" lang="de"/>
</root>
XML,
        ];

        yield 'title is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setTitle('some title'),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media">
    <media:title>some title</media:title>
  </media:content>
</root>
XML,
        ];

        yield 'description is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setDescription('some description'),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media">
    <media:description>some description</media:description>
  </media:content>
</root>
XML,
        ];

        yield 'keywords is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setKeywords('some keyword'),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media">
    <media:keywords>some keyword</media:keywords>
  </media:content>
</root>
XML,
        ];

        yield 'Rating is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->setRating(new MediaRating('adult')),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media">
    <media:rating>adult</media:rating>
  </media:content>
</root>
XML,
        ];

        yield 'one thumbnail is given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->addThumbnails(new MediaThumbnail('https://example.org/some-thumbnail.jpg')),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media">
    <media:thumbnail url="https://example.org/some-thumbnail.jpg"/>
  </media:content>
</root>
XML,
        ];
        yield 'two thumbnails are given' => [
            'content' => (new MediaContent())
                ->setUrl('https://example.org/some-media')
                ->addThumbnails(
                    new MediaThumbnail('https://example.org/some-thumbnail.jpg'),
                    new MediaThumbnail('https://example.org/another-thumbnail.jpg'),
                ),
            'expected' => <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:content url="https://example.org/some-media">
    <media:thumbnail url="https://example.org/some-thumbnail.jpg"/>
    <media:thumbnail url="https://example.org/another-thumbnail.jpg"/>
  </media:content>
</root>
XML,
        ];
    }
}
