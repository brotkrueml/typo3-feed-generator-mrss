<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Tests\Unit\Renderer\Node;

use Brotkrueml\FeedGeneratorMrss\Renderer\Exception\MissingRequiredPropertyException;
use Brotkrueml\FeedGeneratorMrss\Renderer\Exception\WrongAudienceInRatingException;
use Brotkrueml\FeedGeneratorMrss\Renderer\Node\MediaRatingNode;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaRating;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(MediaRatingNode::class)]
final class MediaRatingNodeTest extends TestCase
{
    private \DOMDocument $document;
    private MediaRatingNode $subject;

    protected function setUp(): void
    {
        $this->document = new \DOMDocument('1.0', 'utf-8');
        $this->document->formatOutput = true;

        $rootElement = $this->document->appendChild($this->document->createElement('root'));
        $rootElement->setAttribute('xmlns:media', 'http://search.yahoo.com/mrss/');

        $this->subject = new MediaRatingNode($this->document, $rootElement);
    }

    #[Test]
    public function audienceIsNotSetThenAnExceptionIsThrown(): void
    {
        $this->expectException(MissingRequiredPropertyException::class);
        $this->expectExceptionMessageMatches('#media:rating#');

        $this->subject->add(new MediaRating(''));
    }

    #[Test]
    public function onlyAudienceIsGiven(): void
    {
        $this->subject->add(new MediaRating('adult'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root xmlns:media="http://search.yahoo.com/mrss/">
  <media:rating>adult</media:rating>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    #[Test]
    public function schemeIsGiven(): void
    {
        $this->subject->add(new MediaRating('pg', 'urn:mpaa'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root xmlns:media="http://search.yahoo.com/mrss/">
  <media:rating scheme="urn:mpaa">pg</media:rating>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    #[Test]
    public function audienceIsAdultWithEmptyScheme(): void
    {
        $this->subject->add(new MediaRating('adult'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root xmlns:media="http://search.yahoo.com/mrss/">
  <media:rating>adult</media:rating>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    #[Test]
    public function audienceIsNonAdultWithEmptyScheme(): void
    {
        $this->subject->add(new MediaRating('nonadult'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root xmlns:media="http://search.yahoo.com/mrss/">
  <media:rating>nonadult</media:rating>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    #[Test]
    public function audienceIsAdultWithUrnSimpleScheme(): void
    {
        $this->subject->add(new MediaRating('adult', 'urn:simple'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root xmlns:media="http://search.yahoo.com/mrss/">
  <media:rating scheme="urn:simple">adult</media:rating>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    #[Test]
    public function audienceIsNonadultWithUrnSimpleScheme(): void
    {
        $this->subject->add(new MediaRating('nonadult', 'urn:simple'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root xmlns:media="http://search.yahoo.com/mrss/">
  <media:rating scheme="urn:simple">nonadult</media:rating>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    #[Test]
    #[DataProvider('providerForWrongUrnSimpleAudience')]
    public function exceptionIsThrownWhenWrongAudienceIsGivenForUrnSimpleScheme(MediaRating $rating): void
    {
        $this->expectException(WrongAudienceInRatingException::class);
        $this->expectExceptionMessageMatches('#' . $rating->getAudience() . '#');

        $this->subject->add($rating);
    }

    public static function providerForWrongUrnSimpleAudience(): iterable
    {
        yield 'With empty scheme' => [
            new MediaRating('wrong-audience'),
        ];

        yield 'With urn:simple scheme' => [
            new MediaRating('wrong-audience', 'urn:simple'),
        ];
    }
}
