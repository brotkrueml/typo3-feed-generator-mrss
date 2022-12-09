<?php

declare(strict_types=1);

/*
 * This file is part of the "feed_generator_mrss" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\FeedGeneratorMrss\ValueObject;

use Brotkrueml\FeedGenerator\Contract\ExtensionContentInterface;
use Brotkrueml\FeedGeneratorMrss\Enumeration\Expression;
use Brotkrueml\FeedGeneratorMrss\Enumeration\Medium;

final class MediaContent implements ExtensionContentInterface
{
    // Attributes for <media:content>
    private int $bitrate = 0;
    private int $channels = 0;
    private int $duration = 0;
    private ?Expression $expression = null;
    private int $fileSize = 0;
    private int $framerate = 0;
    private int $height = 0;
    private bool $isDefault = false;
    private string $lang = '';
    private ?Medium $medium = null;
    private string $samplingrate = '';
    private string $type = '';
    private string $url = '';
    private int $width = 0;

    // Sub-elements of <media:content>
    // todo:
    // - backLinks
    // - category
    // - comments
    // - community
    // - copyright
    // - credit
    // - embed
    // - hash
    // - license
    // - peerLink
    // - price
    // - responses
    // - restriction
    // - rights
    // - scenes
    // - status
    // - subTitle
    // - text
    private string $description = '';
    private string $keywords = '';
    private ?MediaPlayer $player = null;
    private ?MediaRating $rating = null;
    /**
     * @var MediaThumbnail[]
     */
    private array $thumbnails = [];
    private string $title = '';

    public function getBitrate(): int
    {
        return $this->bitrate;
    }

    public function setBitrate(int $bitrate): self
    {
        $this->bitrate = $bitrate;

        return $this;
    }

    public function getChannels(): int
    {
        return $this->channels;
    }

    public function setChannels(int $channels): self
    {
        $this->channels = $channels;

        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getExpression(): ?Expression
    {
        return $this->expression;
    }

    public function setExpression(?Expression $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    public function getFramerate(): int
    {
        return $this->framerate;
    }

    public function setFramerate(int $framerate): self
    {
        $this->framerate = $framerate;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getIsDefault(): bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(bool $isDefault): self
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getMedium(): ?Medium
    {
        return $this->medium;
    }

    public function setMedium(?Medium $medium): self
    {
        $this->medium = $medium;

        return $this;
    }

    public function getSamplingrate(): string
    {
        return $this->samplingrate;
    }

    public function setSamplingrate(string $samplingrate): self
    {
        $this->samplingrate = $samplingrate;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getKeywords(): string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getPlayer(): ?MediaPlayer
    {
        return $this->player;
    }

    public function setPlayer(?MediaPlayer $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getRating(): ?MediaRating
    {
        return $this->rating;
    }

    public function setRating(?MediaRating $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return MediaThumbnail[]
     */
    public function getThumbnails(): array
    {
        return $this->thumbnails;
    }

    public function addThumbnails(MediaThumbnail ...$thumbnails): self
    {
        $this->thumbnails = [...$this->thumbnails, ...$thumbnails];

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
