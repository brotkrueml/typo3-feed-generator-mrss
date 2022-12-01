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
use Brotkrueml\FeedGeneratorMrss\Renderer\MissingRequiredPropertyException;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaThumbnail;

/**
 * Renders a thumbnail node like "<media:thumbnail url="http://www.foo.com/keyframe.jpg" width="75" height="50" time="12:05:01.123"/>"
 * @internal
 */
final class MediaThumbnailNode
{
    public function __construct(
        private readonly \DOMDocument $document,
        private readonly \DOMElement $parentElement,
    ) {
    }

    public function add(MediaThumbnail $thumbnail): void
    {
        if ($thumbnail->getUrl() === '') {
            throw MissingRequiredPropertyException::forElement('media:thumbnail/url');
        }

        $thumbnailNode = $this->document->createElement((new Media())->getQualifiedName() . ':thumbnail');

        $thumbnailNode->setAttribute('url', $thumbnail->getUrl());
        if ($thumbnail->getHeight() > 0) {
            $thumbnailNode->setAttribute('height', (string)$thumbnail->getHeight());
        }
        if ($thumbnail->getWidth() > 0) {
            $thumbnailNode->setAttribute('width', (string)$thumbnail->getWidth());
        }
        if ($thumbnail->getTime() !== '') {
            $thumbnailNode->setAttribute('time', $thumbnail->getTime());
        }

        $this->parentElement->appendChild($thumbnailNode);
    }
}
