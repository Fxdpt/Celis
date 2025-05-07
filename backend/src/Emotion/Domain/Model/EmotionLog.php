<?php

namespace App\Emotion\Domain\Model;

use App\Emotion\Domain\Model\PrimaryEmotion\PrimaryEmotion;
use App\Emotion\Domain\Model\SecondaryEmotion\SecondaryEmotion;
use App\Emotion\Domain\Model\TertiaryEmotion\TertiaryEmotion;

final class EmotionLog
{
    public function __construct(
        private ?int $id,
        private PrimaryEmotion $primaryEmotion,
        private SecondaryEmotion $secondaryEmotion,
        private TertiaryEmotion $tertiaryEmotion,
        private \DateTimeImmutable $date,
        private ?string $comment,
        private ?TriggerEvent $triggerEvent
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrimaryEmotion(): PrimaryEmotion
    {
        return $this->primaryEmotion;
    }

    public function getSecondaryEmotion(): SecondaryEmotion
    {
        return $this->secondaryEmotion;
    }

    public function getTertiaryEmotion(): TertiaryEmotion
    {
        return $this->tertiaryEmotion;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getTriggerEvent(): ?TriggerEvent
    {
        return $this->triggerEvent;
    }
}