<?php

namespace App\Emotion\Application\Exception;

final class EmotionLogValidationException extends \Exception
{
    public static function invalidEmotionIds(array $ids): self
    {
        return new self(sprintf("Invalid Emotion Ids [%s]", implode($ids)));
    }

    public static function emotionDateIsInFuture(\DateTimeImmutable $date): self
    {
        return new self(sprintf("Emotion log date [%d] is in future", $date->getTimestamp()));
    }
}