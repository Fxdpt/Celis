<?php

namespace App\Emotion\Infrastructure\CreateEmotionLog\API\Controller;

use App\Emotion\Application\UseCase\CreateEmotionLog\CreateEmotionLog;
use App\Emotion\Infrastructure\CreateEmotionLog\API\Input\CreateEmotionLogInput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class CreateEmotionLogController extends AbstractController
{
    #[Route(path: '/emotions/logs', name: 'create_emotion_log', methods: 'POST')]
    public function __invoke(
        #[MapRequestPayload()] CreateEmotionLogInput $input,
        CreateEmotionLog $useCase
    )
    {
        return $useCase($input->toRequest());
    }
}