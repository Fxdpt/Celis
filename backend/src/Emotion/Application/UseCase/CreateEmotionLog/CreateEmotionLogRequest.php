<?php

namespace App\Emotion\Application\UseCase\CreateEmotionLog;

final class CreateEmotionLogRequest
{
    public function __construct(
        public readonly int $primaryEmotionId,
        public readonly int $secondaryEmotionId,
        public readonly int $tertiaryEmotionId,
        public readonly \DateTimeImmutable $date,
        public readonly ?string $comment = null,
        public readonly ?string $triggerEvent = null
    ) {
    }
}