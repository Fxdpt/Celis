<?php

namespace App\Emotion\Application\UseCase\ListPrimaryEmotions;

use App\Common\Response\Application\ApplicationError;
use App\Common\Response\Application\ErrorCodeEnum;
use App\Emotion\Application\Repository\ReadPrimaryEmotionRepositoryInterface;

final class ListPrimaryEmotions
{
    public function __construct(private readonly ReadPrimaryEmotionRepositoryInterface $readRepository)
    {
    }

    public function __invoke(): array|ApplicationError
    {
        try {
            return $this->readRepository->findAll();
        } catch (\Throwable) {
            return new ApplicationError(
                ErrorCodeEnum::UNCONTROLLED_ERROR,
                'An error occured during listing primary emotions'
            );
        }
    }
}