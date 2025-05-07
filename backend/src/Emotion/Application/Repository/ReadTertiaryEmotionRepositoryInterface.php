<?php

namespace App\Emotion\Application\Repository;

use App\Emotion\Domain\Model\TertiaryEmotion\TertiaryEmotion;

interface ReadTertiaryEmotionRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @return TertiaryEmotion[]
     */
    public function findAll(): array;
}