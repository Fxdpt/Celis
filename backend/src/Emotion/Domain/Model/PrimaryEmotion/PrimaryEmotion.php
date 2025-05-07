<?php

namespace App\Emotion\Domain\Model\PrimaryEmotion;

final readonly class PrimaryEmotion
{
    public function __construct(
        private int $id,
        private PrimaryEmotionLabelEnum $emotionLabel,
        private array $emotionLogs
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmotionLabel(): PrimaryEmotionLabelEnum
    {
        return $this->emotionLabel;
    }

    public function getEmotionLogs(): array
    {
        return $this->emotionLogs;
    }
}