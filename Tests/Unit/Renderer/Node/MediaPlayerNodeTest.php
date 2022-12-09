<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\Renderer\Node;

use Brotkrueml\FeedGeneratorMrss\Renderer\MissingRequiredPropertyException;
use Brotkrueml\FeedGeneratorMrss\Renderer\Node\MediaPlayerNode;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaPlayer;
use PHPUnit\Framework\TestCase;

final class MediaPlayerNodeTest extends TestCase
{
    private \DOMDocument $document;
    private MediaPlayerNode $subject;

    protected function setUp(): void
    {
        $this->document = new \DOMDocument('1.0', 'utf-8');
        $this->document->formatOutput = true;

        $rootElement = $this->document->appendChild($this->document->createElement('root'));

        $this->subject = new MediaPlayerNode($this->document, $rootElement);
    }

    /**
     * @test
     */
    public function urlIsNotSetThenAnExceptionIsThrown(): void
    {
        $this->expectException(MissingRequiredPropertyException::class);
        $this->expectExceptionMessageMatches('#media:player/url#');

        $this->subject->add(new MediaPlayer(''));
    }

    /**
     * @test
     */
    public function onlyUrlIsGiven(): void
    {
        $this->subject->add(new MediaPlayer('https://example.org/some-thumbnail.jpg'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:player url="https://example.org/some-thumbnail.jpg"/>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    /**
     * @test
     */
    public function heightIsGiven(): void
    {
        $this->subject->add(new MediaPlayer('https://example.org/some-thumbnail.jpg', height: 200));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:player url="https://example.org/some-thumbnail.jpg" height="200"/>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    /**
     * @test
     */
    public function widthIsGiven(): void
    {
        $this->subject->add(new MediaPlayer('https://example.org/some-thumbnail.jpg', width: 400));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:player url="https://example.org/some-thumbnail.jpg" width="400"/>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }
}
