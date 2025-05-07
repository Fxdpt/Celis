<?php

namespace App\Emotion\Application\Repository;

use App\Emotion\Domain\Model\PrimaryEmotion\PrimaryEmotion;

interface ReadPrimaryEmotionRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @return PrimaryEmotion[]
     */
    public function findAll(): array;
}