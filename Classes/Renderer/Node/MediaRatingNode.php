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
use Brotkrueml\FeedGeneratorMrss\Renderer\WrongAudienceInRatingException;
use Brotkrueml\FeedGeneratorMrss\ValueObject\MediaRating;

/**
 * Renders a rating node like "<media:rating scheme="urn:icra">r (cz 1 lz 1 nz 1 oz 1 vz 1)</media:rating>"
 * @internal
 */
final class MediaRatingNode
{
    public function __construct(
        private readonly \DOMDocument $document,
        private readonly \DOMElement $parentElement,
    ) {
    }

    public function add(MediaRating $rating): void
    {
        if ($rating->getAudience() === '') {
            throw MissingRequiredPropertyException::forElement('media:rating');
        }

        $this->guardUrnSimpleScheme($rating);

        $ratingNode = $this->document->createElement((new Media())->getQualifiedName() . ':rating');
        $ratingNode->appendChild($this->document->createTextNode($rating->getAudience()));
        if ($rating->getScheme() !== '') {
            $ratingNode->setAttribute('scheme', $rating->getScheme());
        }

        $this->parentElement->appendChild($ratingNode);
    }

    private function guardUrnSimpleScheme(MediaRating $rating): void
    {
        $scheme = $rating->getScheme();
        if ($scheme !== '' && $scheme !== 'urn:simple') {
            return;
        }

        $audience = $rating->getAudience();
        if ($audience === 'adult') {
            return;
        }
        if ($audience === 'nonadult') {
            return;
        }

        throw WrongAudienceInRatingException::forRating($rating);
    }
}
