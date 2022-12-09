<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Renderer\Node;

use Brotkrueml\FeedGeneratorMrss\Media;
use Brotkrueml\FeedGeneratorMrss\Renderer\Exception\MissingRequiredPropertyException;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaCategory;

/**
 * Renders a category node like "<media:category scheme="urn:flickr:tags">ycantpark mobile</media:category>"/>"
 * @internal
 */
final class MediaCategoryNode
{
    public function __construct(
        private readonly \DOMDocument $document,
        private readonly \DOMElement $parentElement,
    ) {
    }

    public function add(MediaCategory $category): void
    {
        if ($category->getTaxonomy() === '') {
            throw MissingRequiredPropertyException::forElement('media:category');
        }

        $categoryNode = $this->document->createElement((new Media())->getQualifiedName() . ':category');

        $categoryNode->appendChild($this->document->createTextNode($category->getTaxonomy()));
        if ($category->getScheme() !== '') {
            $categoryNode->setAttribute('scheme', $category->getScheme());
        }
        if ($category->getLabel() !== '') {
            $categoryNode->setAttribute('label', $category->getLabel());
        }

        $this->parentElement->appendChild($categoryNode);
    }
}
