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
use Brotkrueml\FeedGeneratorMrss\Renderer\Node\MediaCategoryNode;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaCategory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Brotkrueml\FeedGeneratorMrss\Renderer\Node\MediaCategoryNode
 */
final class MediaCategoryNodeTest extends TestCase
{
    private \DOMDocument $document;
    private MediaCategoryNode $subject;

    protected function setUp(): void
    {
        $this->document = new \DOMDocument('1.0', 'utf-8');
        $this->document->formatOutput = true;

        $rootElement = $this->document->appendChild($this->document->createElement('root'));

        $this->subject = new MediaCategoryNode($this->document, $rootElement);
    }

    /**
     * @test
     */
    public function audienceIsNotSetThenAnExceptionIsThrown(): void
    {
        $this->expectException(MissingRequiredPropertyException::class);
        $this->expectExceptionMessageMatches('#media:category#');

        $this->subject->add(new MediaCategory(''));
    }

    /**
     * @test
     */
    public function onlyTaxonomyIsGiven(): void
    {
        $this->subject->add(new MediaCategory('music/artist/album/song'));

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:category>music/artist/album/song</media:category>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    /**
     * @test
     */
    public function schemeIsGiven(): void
    {
        $this->subject->add(
            new MediaCategory(
                'music/artist/album/song',
                'http://search.yahoo.com/mrss/category_schema',
            ),
        );

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:category scheme="http://search.yahoo.com/mrss/category_schema">music/artist/album/song</media:category>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }

    /**
     * @test
     */
    public function labelIsGiven(): void
    {
        $this->subject->add(
            new MediaCategory(
                'Arts/Movies/Titles/A/Ace_Ventura_Series/Ace_Ventura_ -_Pet_Detective',
                label: 'Ace Ventura - Pet Detective',
            ),
        );

        $expected = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root>
  <media:category label="Ace Ventura - Pet Detective">Arts/Movies/Titles/A/Ace_Ventura_Series/Ace_Ventura_ -_Pet_Detective</media:category>
</root>
XML;

        self::assertXmlStringEqualsXmlString($expected, $this->document->saveXML());
    }
}
