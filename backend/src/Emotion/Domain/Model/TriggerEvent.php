<?php

namespace App\Emotion\Domain\Model;

final class TriggerEvent
{
    public function __construct(
        private string $name
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}