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
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaPlayer;

/**
 * Renders a player node like "<media:player url="http://www.foo.com/player?id=1111" height="200" width="400"/>"
 * @internal
 */
final class MediaPlayerNode
{
    public function __construct(
        private readonly \DOMDocument $document,
        private readonly \DOMElement $parentElement,
    ) {
    }

    public function add(MediaPlayer $player): void
    {
        if ($player->getUrl() === '') {
            throw MissingRequiredPropertyException::forElement('media:player/url');
        }

        $playerNode = $this->document->createElement((new Media())->getQualifiedName() . ':player');

        $playerNode->setAttribute('url', $player->getUrl());
        if ($player->getHeight() > 0) {
            $playerNode->setAttribute('height', (string)$player->getHeight());
        }
        if ($player->getWidth() > 0) {
            $playerNode->setAttribute('width', (string)$player->getWidth());
        }

        $this->parentElement->appendChild($playerNode);
    }
}
