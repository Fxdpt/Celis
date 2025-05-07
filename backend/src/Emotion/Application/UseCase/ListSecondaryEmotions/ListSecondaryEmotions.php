<?php

namespace App\Emotion\Application\UseCase\ListSecondaryEmotions;

use App\Common\Response\Application\ApplicationError;
use App\Common\Response\Application\ErrorCodeEnum;
use App\Emotion\Application\Repository\ReadSecondaryEmotionRepositoryInterface;

final class ListSecondaryEmotions
{
    public function __construct(private readonly ReadSecondaryEmotionRepositoryInterface $readRepository)
    {
    }

    public function __invoke(): array|ApplicationError
    {
        try {
            return $this->readRepository->findAll();
        } catch (\Throwable) {
            return new ApplicationError(
                ErrorCodeEnum::UNCONTROLLED_ERROR,
                'An error occured during listing secondary emotions'
            );
        }
    }
}