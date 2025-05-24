<?php

namespace App\Emotion\Application\Repository;

use App\Emotion\Domain\Model\TertiaryEmotion\TertiaryEmotion;

interface ReadTertiaryEmotionRepositoryInterface
{
    /**
     * @return TertiaryEmotion[]
     */
    public function findAll(): array;

    /**
     * @param int $emotionId
     *
     * @return TertiaryEmotion
     */
    public function findOneById(int $emotionId): TertiaryEmotion;

    /**
     * @param int $emotionId
     *
     * @return bool
     */
    public function exists(int $emotionId): bool;
}