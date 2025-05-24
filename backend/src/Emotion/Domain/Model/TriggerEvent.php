<?php

namespace App\Emotion\Domain\Model;

final class TriggerEvent
{
    public function __construct(
        private ?int $id,
        private string $name,
    ) {
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}