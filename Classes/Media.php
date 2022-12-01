<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss;

use Brotkrueml\FeedGenerator\Contract\ExtensionContentInterface;
use Brotkrueml\FeedGenerator\Contract\XmlExtensionInterface;
use Brotkrueml\FeedGenerator\Contract\XmlExtensionRendererInterface;
use Brotkrueml\FeedGeneratorMrss\Renderer\MediaContentRenderer;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent;

final class Media implements XmlExtensionInterface
{
    private const NAMESPACE = 'http://search.yahoo.com/mrss/';
    private const QUALIFIED_NAME = 'media';

    public function canHandle(ExtensionContentInterface $content): bool
    {
        return $content instanceof MediaContent;
    }

    public function getNamespace(): string
    {
        return self::NAMESPACE;
    }

    public function getQualifiedName(): string
    {
        return self::QUALIFIED_NAME;
    }

    public function getXmlRenderer(): XmlExtensionRendererInterface
    {
        return new MediaContentRenderer();
    }
}
