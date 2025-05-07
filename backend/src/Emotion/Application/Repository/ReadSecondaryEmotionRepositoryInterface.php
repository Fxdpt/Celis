<?php

namespace App\Emotion\Application\Repository;

use App\Emotion\Domain\Model\SecondaryEmotion\SecondaryEmotion;

interface ReadSecondaryEmotionRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @return SecondaryEmotion[]
     */
    public function findAll(): array;
}