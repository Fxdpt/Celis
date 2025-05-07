<?php

namespace App\Emotion\Infrastructure\EnumConverter;

use App\Emotion\Domain\Model\PrimaryEmotion\PrimaryEmotionLabelEnum;

final class PrimaryEmotionLabelConverter
{
    private const DISGUST = 'disgust';
    private const ANGER = 'anger';
    private const FEAR = 'fear';
    private const SURPRISE = 'surprise';
    private const HAPPY = 'happy';
    private const SAD = 'sad';

    public static function toEnum(string $label): PrimaryEmotionLabelEnum
    {
        return match ($label) {
            self::DISGUST  => PrimaryEmotionLabelEnum::DISGUST,
            self::ANGER    => PrimaryEmotionLabelEnum::ANGER,
            self::FEAR     => PrimaryEmotionLabelEnum::FEAR,
            self::SURPRISE => PrimaryEmotionLabelEnum::SURPRISE,
            self::HAPPY    => PrimaryEmotionLabelEnum::HAPPY,
            self::SAD      => PrimaryEmotionLabelEnum::SAD,
            default        => throw new \InvalidArgumentException("Invalid primary emotion label: $label"),
        };
    }

    public static function toString(PrimaryEmotionLabelEnum $enum): string
    {
        return strtolower($enum->name);
    }
}