<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Renderer;

use Brotkrueml\FeedGenerator\Contract\ExtensionContentInterface;
use Brotkrueml\FeedGenerator\Contract\XmlExtensionRendererInterface;
use Brotkrueml\FeedGeneratorMrss\Enumeration\Expression;
use Brotkrueml\FeedGeneratorMrss\Enumeration\Medium;
use Brotkrueml\FeedGeneratorMrss\Media;
use Brotkrueml\FeedGeneratorMrss\Renderer\Node\MediaPlayerNode;
use Brotkrueml\FeedGeneratorMrss\Renderer\Node\MediaRatingNode;
use Brotkrueml\FeedGeneratorMrss\Renderer\Node\MediaThumbnailNode;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaPlayer;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaRating;

final class MediaContentRenderer implements XmlExtensionRendererInterface
{
    private \DOMDocument $document;

    /**
     * @param MediaContent $content
     */
    public function render(ExtensionContentInterface $content, \DOMNode $parent, \DOMDocument $document): void
    {
        $this->document = $document;

        if ($content->getUrl() === '' && $content->getPlayer() === null) {
            throw new MissingRequiredMediaContentException(
                'Either url or player must be given for media content',
                1669902205
            );
        }

        $qualifiedName = (new Media())->getQualifiedName();
        $contentElement = $this->document->createElement($qualifiedName . ':content');

        $this->addAttribute('url', $content->getUrl(), $contentElement);
        $this->addAttribute('fileSize', $content->getFileSize(), $contentElement);
        $this->addAttribute('type', $content->getType(), $contentElement);
        $this->addAttribute('medium', $content->getMedium() instanceof Medium ? $content->getMedium()->value : '', $contentElement);
        $this->addAttribute('isDefault', $content->getIsDefault() ? 'true' : '', $contentElement);
        $this->addAttribute('expression', $content->getExpression() instanceof Expression ? $content->getExpression()->value : '', $contentElement);
        $this->addAttribute('bitrate', $content->getBitrate(), $contentElement);
        $this->addAttribute('framerate', $content->getFramerate(), $contentElement);
        $this->addAttribute('samplingrate', $content->getSamplingrate(), $contentElement);
        $this->addAttribute('channels', $content->getChannels(), $contentElement);
        $this->addAttribute('duration', $content->getDuration(), $contentElement);
        $this->addAttribute('height', $content->getHeight(), $contentElement);
        $this->addAttribute('width', $content->getWidth(), $contentElement);
        $this->addAttribute('lang', $content->getLang(), $contentElement);

        $this->addTextNode($qualifiedName . ':title', $content->getTitle(), $contentElement);
        $this->addTextNode($qualifiedName . ':description', $content->getDescription(), $contentElement);
        $this->addTextNode($qualifiedName . ':keywords', $content->getKeywords(), $contentElement);
        $thumbnailNode = new MediaThumbnailNode($this->document, $contentElement);
        foreach ($content->getThumbnails() as $thumbnail) {
            $thumbnailNode->add($thumbnail);
        }
        if ($content->getPlayer() instanceof MediaPlayer) {
            $playerNode = new MediaPlayerNode($this->document, $contentElement);
            $playerNode->add($content->getPlayer());
        }
        if ($content->getRating() instanceof MediaRating) {
            $ratingNode = new MediaRatingNode($this->document, $contentElement);
            $ratingNode->add($content->getRating());
        }

        $parent->appendChild($contentElement);
    }

    private function addAttribute(string $name, string|int $value, \DOMElement $node): void
    {
        if ($value === '') {
            return;
        }

        if ($value === 0) {
            return;
        }

        $node->setAttribute($name, (string)$value);
    }

    private function addTextNode(string $name, string $value, \DOMElement $parentElement): void
    {
        if ($value === '') {
            return;
        }

        $textElement = $this->document->createElement($name);
        $textElement->appendChild($this->document->createTextNode($value));
        $parentElement->appendChild($textElement);
    }
}
