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
use Brotkrueml\FeedGeneratorMrss\Renderer\Node\MediaThumbnailNode;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaThumbnail;
use PHPUnit\Framework\TestCase;

final class MediaThumbnailNodeTest extends TestCase
{
    private \DOMDocument $document;
    private MediaThumbnailNode $subject;

    protected function setUp(): void
    {
        $this->document = new \DOMDocument('1.0', 'utf-8');
        $this->document->formatOutput = true;

        $rootElement = $this->document->appendChild($this->document->createElement('root'));

        $this->subject = new MediaThumbnailNode($this->document, $rootElement);
    }

    /**
     * @test
     */
    public function urlIsNotSetThenAnExceptionIsThrown(): void
    {
        $this->expectException(MissingRequiredPropertyException::class);
        $this->expectExceptionMessageMatches('#media:thumbnail/url#');

        $this->subject->add(new MediaThumbnail(''));
    }

    /**
     * @test
     */
    public function onlyUrlIsGiven(): void
    {
        $this->subject->add(new MediaThumbnail('https://example.org/some-thumbnail.jpg'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:thumbnail url="https://example.org/some-thumbnail.jpg"/>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    /**
     * @test
     */
    public function heightIsGiven(): void
    {
        $this->subject->add(new MediaThumbnail('https://example.org/some-thumbnail.jpg', height: 50));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:thumbnail url="https://example.org/some-thumbnail.jpg" height="50"/>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    /**
     * @test
     */
    public function widthIsGiven(): void
    {
        $this->subject->add(new MediaThumbnail('https://example.org/some-thumbnail.jpg', width: 75));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:thumbnail url="https://example.org/some-thumbnail.jpg" width="75"/>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    /**
     * @test
     */
    public function timeIsGiven(): void
    {
        $this->subject->add(new MediaThumbnail('https://example.org/some-thumbnail.jpg', time: '12:05:01.123'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:thumbnail url="https://example.org/some-thumbnail.jpg" time="12:05:01.123"/>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }
}
