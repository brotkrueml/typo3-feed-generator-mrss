<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\Renderer;

use Brotkrueml\FeedGenerator\Contract\ExtensionElementInterface;
use Brotkrueml\FeedGenerator\Contract\XmlExtensionRendererInterface;
use Brotkrueml\FeedGeneratorMrss\Enumeration\Expression;
use Brotkrueml\FeedGeneratorMrss\Enumeration\Medium;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent;

final class MediaRenderer implements XmlExtensionRendererInterface
{
    private \DOMDocument $document;

    public function render(ExtensionElementInterface $element, \DOMNode $parent, \DOMDocument $document): void
    {
        $this->document = $document;

        if (! $element instanceof MediaContent) {
            // @todo Make a better exception
            throw new \RuntimeException('something went wrong');
        }

        // @todo Check if either url or player is set

        // @todo Use media prefix from Media->getQualifiedName()
        $contentNode = $this->document->createElement('media:content');

        $this->addAttribute('url', $element->getUrl(), $contentNode);
        $this->addAttribute('fileSize', $element->getFileSize(), $contentNode);
        $this->addAttribute('type', $element->getType(), $contentNode);
        $this->addAttribute('medium', $element->getMedium() instanceof Medium ? $element->getMedium()->value : '', $contentNode);
        $this->addAttribute('isDefault', $element->getIsDefault() ? 'true' : '', $contentNode);
        $this->addAttribute('expression', $element->getExpression() instanceof Expression ? $element->getExpression()->value : '', $contentNode);
        $this->addAttribute('bitrate', $element->getBitrate(), $contentNode);
        $this->addAttribute('framerate', $element->getFramerate(), $contentNode);
        $this->addAttribute('samplingrate', $element->getSamplingrate(), $contentNode);
        $this->addAttribute('channels', $element->getChannels(), $contentNode);
        $this->addAttribute('duration', $element->getDuration(), $contentNode);
        $this->addAttribute('height', $element->getHeight(), $contentNode);
        $this->addAttribute('width', $element->getWidth(), $contentNode);
        $this->addAttribute('lang', $element->getLang(), $contentNode);

        $this->addTextNode('media:title', $element->getTitle(), $contentNode);
        $this->addTextNode('media:description', $element->getDescription(), $contentNode);
        $this->addTextNode('media:keywords', $element->getKeywords(), $contentNode);

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
