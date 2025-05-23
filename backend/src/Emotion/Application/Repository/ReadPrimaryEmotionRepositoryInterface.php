<?php

namespace App\Emotion\Application\Repository;

use App\Emotion\Domain\Model\PrimaryEmotion\PrimaryEmotion;

interface ReadPrimaryEmotionRepositoryInterface
{
    /**
     * @return PrimaryEmotion[]
     */
    public function findAll(): array;

    /**
     * @param int $emotionId
     *
     * @return PrimaryEmotion
     */
    public function findOneById(int $emotionId): PrimaryEmotion;

    /**
     * @param int $emotionId
     *
     * @return bool
     */
    public function exists(int $emotionId): bool;
}