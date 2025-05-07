<?php

namespace App\Emotion\Infrastructure\EnumConverter;

use App\Emotion\Domain\Model\SecondaryEmotion\SecondaryEmotionLabelEnum;

final class SecondaryEmotionLabelConverter
{
    private const AVOIDANCE    = 'avoidance';
    private const AWFUL        = 'awful';
    private const DISAPPOINTED = 'disappointed';
    private const DISAPPROVAL  = 'disapproval';
    private const CRITICAL     = 'critical';
    private const DISTANT      = 'distant';
    private const FRUSTRATED   = 'frustrated';
    private const AGGRESSIVE   = 'aggressive';
    private const MAD          = 'mad';
    private const HATEFUL      = 'hateful';
    private const THREATENED   = 'threatened';
    private const HURT         = 'hurt';
    private const HUMILIATED   = 'humiliated';
    private const REJECTED     = 'rejected';
    private const SUBMISSIVE   = 'submissive';
    private const INSECURE     = 'insecure';
    private const ANXIOUS      = 'anxious';
    private const SCARED       = 'scared';
    private const STARTLED     = 'startled';
    private const CONFUSED     = 'confused';
    private const AMAZED       = 'amazed';
    private const EXCITED      = 'excited';
    private const JOYFUL       = 'joyful';
    private const INTERESTED   = 'interested';
    private const PROUD        = 'proud';
    private const ACCEPTED     = 'accepted';
    private const POWERFUL     = 'powerful';
    private const PEACEFUL     = 'peaceful';
    private const INTIMATE     = 'intimate';
    private const OPTIMISTIC   = 'optimistic';
    private const BORED        = 'bored';
    private const LONELY       = 'lonely';
    private const DEPRESSED    = 'depressed';
    private const DESPAIR      = 'despair';
    private const ABANDONED    = 'abandoned';
    private const GUILTY       = 'guilty';

    public static function toEnum(string $label): SecondaryEmotionLabelEnum
    {
        return match ($label) {
            self::AVOIDANCE    => SecondaryEmotionLabelEnum::AVOIDANCE,
            self::AWFUL        => SecondaryEmotionLabelEnum::AWFUL,
            self::DISAPPOINTED => SecondaryEmotionLabelEnum::DISAPPOINTED,
            self::DISAPPROVAL  => SecondaryEmotionLabelEnum::DISAPPROVAL,
            self::CRITICAL     => SecondaryEmotionLabelEnum::CRITICAL,
            self::DISTANT      => SecondaryEmotionLabelEnum::DISTANT,
            self::FRUSTRATED   => SecondaryEmotionLabelEnum::FRUSTRATED,
            self::AGGRESSIVE   => SecondaryEmotionLabelEnum::AGGRESSIVE,
            self::MAD          => SecondaryEmotionLabelEnum::MAD,
            self::HATEFUL      => SecondaryEmotionLabelEnum::HATEFUL,
            self::THREATENED   => SecondaryEmotionLabelEnum::THREATENED,
            self::HURT         => SecondaryEmotionLabelEnum::HURT,
            self::HUMILIATED   => SecondaryEmotionLabelEnum::HUMILIATED,
            self::REJECTED     => SecondaryEmotionLabelEnum::REJECTED,
            self::SUBMISSIVE   => SecondaryEmotionLabelEnum::SUBMISSIVE,
            self::INSECURE     => SecondaryEmotionLabelEnum::INSECURE,
            self::ANXIOUS      => SecondaryEmotionLabelEnum::ANXIOUS,
            self::SCARED       => SecondaryEmotionLabelEnum::SCARED,
            self::STARTLED     => SecondaryEmotionLabelEnum::STARTLED,
            self::CONFUSED     => SecondaryEmotionLabelEnum::CONFUSED,
            self::AMAZED       => SecondaryEmotionLabelEnum::AMAZED,
            self::EXCITED      => SecondaryEmotionLabelEnum::EXCITED,
            self::JOYFUL       => SecondaryEmotionLabelEnum::JOYFUL,
            self::INTERESTED   => SecondaryEmotionLabelEnum::INTERESTED,
            self::PROUD        => SecondaryEmotionLabelEnum::PROUD,
            self::ACCEPTED     => SecondaryEmotionLabelEnum::ACCEPTED,
            self::POWERFUL     => SecondaryEmotionLabelEnum::POWERFUL,
            self::PEACEFUL     => SecondaryEmotionLabelEnum::PEACEFUL,
            self::INTIMATE     => SecondaryEmotionLabelEnum::INTIMATE,
            self::OPTIMISTIC   => SecondaryEmotionLabelEnum::OPTIMISTIC,
            self::BORED        => SecondaryEmotionLabelEnum::BORED,
            self::LONELY       => SecondaryEmotionLabelEnum::LONELY,
            self::DEPRESSED    => SecondaryEmotionLabelEnum::DEPRESSED,
            self::DESPAIR      => SecondaryEmotionLabelEnum::DESPAIR,
            self::ABANDONED    => SecondaryEmotionLabelEnum::ABANDONED,
            self::GUILTY       => SecondaryEmotionLabelEnum::GUILTY,
            default            => throw new \InvalidArgumentException("Invalid secondary emotion label: $label"),
        };
    }

    public static function toString(SecondaryEmotionLabelEnum $enum): string
    {
        return strtolower($enum->name);
    }
}