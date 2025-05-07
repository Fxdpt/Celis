<?php

namespace App\Emotion\Application\UseCase\ListTertiaryEmotions;

use App\Common\Response\Application\ApplicationError;
use App\Common\Response\Application\ErrorCodeEnum;
use App\Emotion\Application\Repository\ReadTertiaryEmotionRepositoryInterface;

final class ListTertiaryEmotions
{
    public function __construct(private readonly ReadTertiaryEmotionRepositoryInterface $readRepository)
    {
    }

    public function __invoke(): array|ApplicationError
    {
        try {
            return $this->readRepository->findAll();
        } catch (\Throwable) {
            return new ApplicationError(
                ErrorCodeEnum::UNCONTROLLED_ERROR,
                'An error occured during listing tertiary emotions'
            );
        }
    }
}