<?php

namespace App\Emotion\Domain\Model\SecondaryEmotion;

final readonly class SecondaryEmotion
{
    public function __construct(
        private int $id,
        private SecondaryEmotionLabelEnum $emotionLabel,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmotionLabel(): SecondaryEmotionLabelEnum
    {
        return $this->emotionLabel;
    }
}