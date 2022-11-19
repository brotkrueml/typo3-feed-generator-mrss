<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss;

use Brotkrueml\FeedGenerator\Contract\ExtensionElementInterface;
use Brotkrueml\FeedGenerator\Contract\ExtensionInterface;
use Brotkrueml\FeedGenerator\Contract\ExtensionRendererInterface;
use Brotkrueml\FeedGeneratorMrss\Renderer\MediaRenderer;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaContent;

final class Media implements ExtensionInterface
{
    public function canHandle(ExtensionElementInterface $element): bool
    {
        return $element instanceof MediaContent;
    }

    public function getNamespace(): string
    {
        return 'http://search.yahoo.com/mrss/';
    }

    public function getQualifiedName(): string
    {
        return 'media';
    }

    public function getRenderer(): ExtensionRendererInterface
    {
        return new MediaRenderer();
    }
}
