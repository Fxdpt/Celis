<?php

namespace App\Emotion\Domain\Model\TertiaryEmotion;

final readonly class TertiaryEmotion
{
    public function __construct(
        private int $id,
        private TertiaryEmotionLabelEnum $emotionLabel,
        private array $emotionLogs
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmotionLabel(): TertiaryEmotionLabelEnum
    {
        return $this->emotionLabel;
    }

    public function getEmotionLogs(): array
    {
        return $this->emotionLogs;
    }
}