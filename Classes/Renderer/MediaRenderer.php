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
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent;

final class MediaRenderer implements XmlExtensionRendererInterface
{
    private \DOMDocument $document;

    public function render(ExtensionContentInterface $content, \DOMNode $parent, \DOMDocument $document): void
    {
        $this->document = $document;

        if (! $content instanceof MediaContent) {
            // @todo Make a better exception
            throw new \RuntimeException('something went wrong');
        }

        // @todo Check if either url or player is set

        // @todo Use media prefix from Media->getQualifiedName()
        $contentNode = $this->document->createElement('media:content');

        $this->addAttribute('url', $content->getUrl(), $contentNode);
        $this->addAttribute('fileSize', $content->getFileSize(), $contentNode);
        $this->addAttribute('type', $content->getType(), $contentNode);
        $this->addAttribute('medium', $content->getMedium() instanceof Medium ? $content->getMedium()->value : '', $contentNode);
        $this->addAttribute('isDefault', $content->getIsDefault() ? 'true' : '', $contentNode);
        $this->addAttribute('expression', $content->getExpression() instanceof Expression ? $content->getExpression()->value : '', $contentNode);
        $this->addAttribute('bitrate', $content->getBitrate(), $contentNode);
        $this->addAttribute('framerate', $content->getFramerate(), $contentNode);
        $this->addAttribute('samplingrate', $content->getSamplingrate(), $contentNode);
        $this->addAttribute('channels', $content->getChannels(), $contentNode);
        $this->addAttribute('duration', $content->getDuration(), $contentNode);
        $this->addAttribute('height', $content->getHeight(), $contentNode);
        $this->addAttribute('width', $content->getWidth(), $contentNode);
        $this->addAttribute('lang', $content->getLang(), $contentNode);

        $this->addTextNode('media:title', $content->getTitle(), $contentNode);
        $this->addTextNode('media:description', $content->getDescription(), $contentNode);
        $this->addTextNode('media:keywords', $content->getKeywords(), $contentNode);

        $parent->appendChild($contentNode);
    }

    private function addAttribute(string $name, string|int $value, \DOMNode $node): void
    {
        if ($value === '') {
            return;
        }

        if ($value === 0) {
            return;
        }

        $node->setAttribute($name, (string)$value);
    }

    private function addTextNode(string $name, string $value, \DOMNode $parent): void
    {
        if ($value === '') {
            return;
        }

        $node = $this->document->createElement($name);
        $node->appendChild($this->document->createTextNode($value));
        $parent->appendChild($node);
    }
}
