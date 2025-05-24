<?php

namespace App\Emotion\Application\UseCase\CreateEmotionLog;

use App\Emotion\Application\Exception\EmotionLogValidationException;
use App\Emotion\Application\Repository\ReadPrimaryEmotionRepositoryInterface;
use App\Emotion\Application\Repository\ReadSecondaryEmotionRepositoryInterface;
use App\Emotion\Application\Repository\ReadTertiaryEmotionRepositoryInterface;
use DateTimeImmutable;

final class EmotionLogValidator
{
    public function __construct(
        private readonly ReadPrimaryEmotionRepositoryInterface $readPrimaryEmotionRepository,
        private readonly ReadSecondaryEmotionRepositoryInterface $readSecondaryEmotionRepository,
        private readonly ReadTertiaryEmotionRepositoryInterface $readTertiaryEmotionRepository,
    ) {}

    public function validateEmotionIds(int $primaryEmotionId, int $secondaryEmotionId, int $tertiaryEmotionId): void
    {
        $errors = [];
        if (! $this->readPrimaryEmotionRepository->exists($primaryEmotionId)) {
            $errors[] = $primaryEmotionId;
        }
        if (! $this->readSecondaryEmotionRepository->exists($secondaryEmotionId)) {
            $errors[] = $secondaryEmotionId;
        }
        if (! $this->readTertiaryEmotionRepository->exists($tertiaryEmotionId)) {
            $errors[] = $tertiaryEmotionId;
        }

        if ($errors !== []) {
            throw EmotionLogValidationException::invalidEmotionIds($errors);
        }
    }

    public function validateDateIsNotInFuture(\DateTimeImmutable $date): void
    {
        if ($date > new DateTimeImmutable()) {
            throw EmotionLogValidationException::emotionDateIsInFuture($date);
        }
    }
}