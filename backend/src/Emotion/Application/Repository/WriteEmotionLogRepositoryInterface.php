<?php

namespace App\Emotion\Application\Repository;

use App\Emotion\Domain\Model\EmotionLog;

interface WriteEmotionLogRepositoryInterface
{
    public function add(EmotionLog $emotionLog): int;
}