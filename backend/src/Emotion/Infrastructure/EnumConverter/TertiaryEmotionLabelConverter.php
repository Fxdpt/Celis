<?php

namespace App\Emotion\Infrastructure\EnumConverter;

use App\Emotion\Domain\Model\TertiaryEmotion\TertiaryEmotionLabelEnum;

final class TertiaryEmotionLabelConverter
{
    private const HESITANT = 'hesitant';
    private const AVERSION = 'aversion';
    private const DETESTABLE = 'detestable';
    private const REVULSION = 'revulsion';
    private const REVOLTED = 'revolted';
    private const REPUGNANT = 'repugnant';
    private const LOATHING = 'loathing';
    private const JUDGMENTAL = 'judgmental';
    private const SARCASTIC = 'sarcastic';
    private const SKEPTICAL = 'skeptical';
    private const SUSPICIOUS = 'suspicious';
    private const WITHDRAWN = 'withdrawn';
    private const IRRITATED = 'irritated';
    private const INFURIATE = 'infuriate';
    private const HOSTILE = 'hostile';
    private const PROVOKED = 'provoked';
    private const ENRAGED = 'enraged';
    private const FURIOUS = 'furious';
    private const VIOLATED = 'violated';
    private const RESENTFUL = 'resentful';
    private const JEALOUS = 'jealous';
    private const INSECURE = 'insecure';
    private const DEVASTATED = 'devastated';
    private const EMBARRASSED = 'embarrassed';
    private const RIDICULED = 'ridiculed';
    private const DISRESPECTED = 'disrespected';
    private const ALIENATED = 'alienated';
    private const INADEQUATE = 'inadequate';
    private const INSIGNIFICANT = 'insignificant';
    private const WORTHLESS = 'worthless';
    private const INFERIOR = 'inferior';
    private const WORRIED = 'worried';
    private const OVERWHELMED = 'overwhelmed';
    private const FRIGHTENED = 'frightened';
    private const TERRIFIED = 'terrified';
    private const SHOCKED = 'shocked';
    private const DISMAYED = 'dismayed';
    private const DISILLUSIONED = 'disillusioned';
    private const PERPLEXED = 'perplexed';
    private const ASTONISHED = 'astonished';
    private const AWE = 'awe';
    private const EAGER = 'eager';
    private const ENERGETIC = 'energetic';
    private const LIBERATED = 'liberated';
    private const ECSTATIC = 'ecstatic';
    private const AMUSED = 'amused';
    private const INQUISITIVE = 'inquisitive';
    private const IMPORTANT = 'important';
    private const CONFIDENT = 'confident';
    private const RESPECTED = 'respected';
    private const FULFILLED = 'fulfilled';
    private const COURAGEOUS = 'courageous';
    private const PROVOCATIVE = 'provocative';
    private const LOVING = 'loving';
    private const HOPEFUL = 'hopeful';
    private const SENSITIVE = 'sensitive';
    private const PLAYFUL = 'playful';
    private const OPEN = 'open';
    private const INSPIRED = 'inspired';
    private const INDIFFERENT = 'indifferent';
    private const APATHETIC = 'apathetic';
    private const ISOLATED = 'isolated';
    private const ABANDONED = 'abandoned';
    private const EMPTY = 'empty';
    private const VULNERABLE = 'vulnerable';
    private const POWERLESS = 'powerless';
    private const VICTIMIZED = 'victimized';
    private const IGNORED = 'ignored';
    private const ASHAMED = 'ashamed';
    private const REMORSEFUL = 'remorseful';

    public static function toEnum(string $label): TertiaryEmotionLabelEnum
    {
        return match ($label) {
            self::HESITANT => TertiaryEmotionLabelEnum::HESITANT,
            self::AVERSION => TertiaryEmotionLabelEnum::AVERSION,
            self::DETESTABLE => TertiaryEmotionLabelEnum::DETESTABLE,
            self::REVULSION => TertiaryEmotionLabelEnum::REVULSION,
            self::REVOLTED => TertiaryEmotionLabelEnum::REVOLTED,
            self::REPUGNANT => TertiaryEmotionLabelEnum::REPUGNANT,
            self::LOATHING => TertiaryEmotionLabelEnum::LOATHING,
            self::JUDGMENTAL => TertiaryEmotionLabelEnum::JUDGMENTAL,
            self::SARCASTIC => TertiaryEmotionLabelEnum::SARCASTIC,
            self::SKEPTICAL => TertiaryEmotionLabelEnum::SKEPTICAL,
            self::SUSPICIOUS => TertiaryEmotionLabelEnum::SUSPICIOUS,
            self::WITHDRAWN => TertiaryEmotionLabelEnum::WITHDRAWN,
            self::IRRITATED => TertiaryEmotionLabelEnum::IRRITATED,
            self::INFURIATE => TertiaryEmotionLabelEnum::INFURIATE,
            self::HOSTILE => TertiaryEmotionLabelEnum::HOSTILE,
            self::PROVOKED => TertiaryEmotionLabelEnum::PROVOKED,
            self::ENRAGED => TertiaryEmotionLabelEnum::ENRAGED,
            self::FURIOUS => TertiaryEmotionLabelEnum::FURIOUS,
            self::VIOLATED => TertiaryEmotionLabelEnum::VIOLATED,
            self::RESENTFUL => TertiaryEmotionLabelEnum::RESENTFUL,
            self::JEALOUS => TertiaryEmotionLabelEnum::JEALOUS,
            self::INSECURE => TertiaryEmotionLabelEnum::INSECURE,
            self::DEVASTATED => TertiaryEmotionLabelEnum::DEVASTATED,
            self::EMBARRASSED => TertiaryEmotionLabelEnum::EMBARRASSED,
            self::RIDICULED => TertiaryEmotionLabelEnum::RIDICULED,
            self::DISRESPECTED => TertiaryEmotionLabelEnum::DISRESPECTED,
            self::ALIENATED => TertiaryEmotionLabelEnum::ALIENATED,
            self::INADEQUATE => TertiaryEmotionLabelEnum::INADEQUATE,
            self::INSIGNIFICANT => TertiaryEmotionLabelEnum::INSIGNIFICANT,
            self::WORTHLESS => TertiaryEmotionLabelEnum::WORTHLESS,
            self::INFERIOR => TertiaryEmotionLabelEnum::INFERIOR,
            self::WORRIED => TertiaryEmotionLabelEnum::WORRIED,
            self::OVERWHELMED => TertiaryEmotionLabelEnum::OVERWHELMED,
            self::FRIGHTENED => TertiaryEmotionLabelEnum::FRIGHTENED,
            self::TERRIFIED => TertiaryEmotionLabelEnum::TERRIFIED,
            self::SHOCKED => TertiaryEmotionLabelEnum::SHOCKED,
            self::DISMAYED => TertiaryEmotionLabelEnum::DISMAYED,
            self::DISILLUSIONED => TertiaryEmotionLabelEnum::DISILLUSIONED,
            self::PERPLEXED => TertiaryEmotionLabelEnum::PERPLEXED,
            self::ASTONISHED => TertiaryEmotionLabelEnum::ASTONISHED,
            self::AWE => TertiaryEmotionLabelEnum::AWE,
            self::EAGER => TertiaryEmotionLabelEnum::EAGER,
            self::ENERGETIC => TertiaryEmotionLabelEnum::ENERGETIC,
            self::LIBERATED => TertiaryEmotionLabelEnum::LIBERATED,
            self::ECSTATIC => TertiaryEmotionLabelEnum::ECSTATIC,
            self::AMUSED => TertiaryEmotionLabelEnum::AMUSED,
            self::INQUISITIVE => TertiaryEmotionLabelEnum::INQUISITIVE,
            self::IMPORTANT => TertiaryEmotionLabelEnum::IMPORTANT,
            self::CONFIDENT => TertiaryEmotionLabelEnum::CONFIDENT,
            self::RESPECTED => TertiaryEmotionLabelEnum::RESPECTED,
            self::FULFILLED => TertiaryEmotionLabelEnum::FULFILLED,
            self::COURAGEOUS => TertiaryEmotionLabelEnum::COURAGEOUS,
            self::PROVOCATIVE => TertiaryEmotionLabelEnum::PROVOCATIVE,
            self::LOVING => TertiaryEmotionLabelEnum::LOVING,
            self::HOPEFUL => TertiaryEmotionLabelEnum::HOPEFUL,
            self::SENSITIVE => TertiaryEmotionLabelEnum::SENSITIVE,
            self::PLAYFUL => TertiaryEmotionLabelEnum::PLAYFUL,
            self::OPEN => TertiaryEmotionLabelEnum::OPEN,
            self::INSPIRED => TertiaryEmotionLabelEnum::INSPIRED,
            self::INDIFFERENT => TertiaryEmotionLabelEnum::INDIFFERENT,
            self::APATHETIC => TertiaryEmotionLabelEnum::APATHETIC,
            self::ISOLATED => TertiaryEmotionLabelEnum::ISOLATED,
            self::ABANDONED => TertiaryEmotionLabelEnum::ABANDONED,
            self::EMPTY => TertiaryEmotionLabelEnum::EMPTY,
            self::VULNERABLE => TertiaryEmotionLabelEnum::VULNERABLE,
            self::POWERLESS => TertiaryEmotionLabelEnum::POWERLESS,
            self::VICTIMIZED => TertiaryEmotionLabelEnum::VICTIMIZED,
            self::IGNORED => TertiaryEmotionLabelEnum::IGNORED,
            self::ASHAMED => TertiaryEmotionLabelEnum::ASHAMED,
            self::REMORSEFUL => TertiaryEmotionLabelEnum::REMORSEFUL,
            default => throw new \InvalidArgumentException("Invalid tertiary emotion label: $label"),
        };
    }

    public static function toString(TertiaryEmotionLabelEnum $enum): string
    {
        return strtolower($enum->name);
    }
}