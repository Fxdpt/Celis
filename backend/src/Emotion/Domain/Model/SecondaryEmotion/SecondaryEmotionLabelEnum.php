<?php

namespace App\Emotion\Domain\Model\SecondaryEmotion;

enum SecondaryEmotionLabelEnum: string
{
    case AVOIDANCE = 'avoidance';
    case AWFUL = 'awful';
    case DISAPPOINTED = 'disappointed';
    case DISAPPROVAL = 'disapproval';
    case CRITICAL = 'critical';
    case DISTANT = 'distant';
    case FRUSTRATED = 'frustrated';
    case AGGRESSIVE = 'aggressive';
    case MAD = 'mad';
    case HATEFUL = 'hateful';
    case THREATENED = 'threatened';
    case HURT = 'hurt';
    case HUMILIATED = 'humiliated';
    case REJECTED = 'rejected';
    case SUBMISSIVE = 'submissive';
    case INSECURE = 'insecure';
    case ANXIOUS = 'anxious';
    case SCARED = 'scared';
    case STARTLED = 'startled';
    case CONFUSED = 'confused';
    case AMAZED = 'amazed';
    case EXCITED = 'excited';
    case JOYFUL = 'joyful';
    case INTERESTED = 'interested';
    case PROUD = 'proud';
    case ACCEPTED = 'accepted';
    case POWERFUL = 'powerful';
    case PEACEFUL = 'peaceful';
    case INTIMATE = 'intimate';
    case OPTIMISTIC = 'optimistic';
    case BORED = 'bored';
    case LONELY = 'lonely';
    case DEPRESSED = 'depressed';
    case DESPAIR = 'despair';
    case ABANDONED = 'abandoned';
    case GUILTY = 'guilty';
}