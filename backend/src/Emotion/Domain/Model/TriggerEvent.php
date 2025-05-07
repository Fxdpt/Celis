<?php

namespace App\Emotion\Domain\Model;

final class TriggerEvent
{
    public function __construct(
        private ?int $id,
        private string $name,
        private array $emotionLogs
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmotionLogs(): array
    {
        return $this->emotionLogs;
    }
}