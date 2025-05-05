<?php

namespace App\Emotion\Domain\Model;

final class EmotionLog
{
    public function __construct(
        private ?int $id,
        private Emotion $emotion,
        private \DateTimeImmutable $date,
        private ?string $comment,
        private ?TriggerEvent $triggerEvent
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmotion(): Emotion
    {
        return $this->emotion;
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