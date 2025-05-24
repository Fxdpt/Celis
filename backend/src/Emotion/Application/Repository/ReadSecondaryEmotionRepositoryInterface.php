<?php

namespace App\Emotion\Application\Repository;

use App\Emotion\Domain\Model\SecondaryEmotion\SecondaryEmotion;

interface ReadSecondaryEmotionRepositoryInterface
{
    /**
     * @return SecondaryEmotion[]
     */
    public function findAll(): array;

    /**
     * @param int $emotionId
     *
     * @return SecondaryEmotion
     */
    public function findOneById(int $emotionId): SecondaryEmotion;

    /**
     * @param int $emotionId
     *
     * @return bool
     */
    public function exists(int $emotionId): bool;
}