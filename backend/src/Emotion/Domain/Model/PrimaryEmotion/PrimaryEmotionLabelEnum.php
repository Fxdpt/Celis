<?php

namespace App\Emotion\Domain\Model\PrimaryEmotion;

enum PrimaryEmotionLabelEnum: string
{
    case DISGUST = 'disgust';
    case ANGER = 'anger';
    case FEAR = 'fear';
    case SURPRISE = 'surprise';
    case HAPPY = 'happy';
    case SAD = 'sad';
}