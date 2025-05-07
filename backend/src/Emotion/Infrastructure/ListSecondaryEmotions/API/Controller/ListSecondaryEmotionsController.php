<?php

namespace App\Emotion\Infrastructure\ListSecondaryEmotions\API\Controller;

use App\Emotion\Application\UseCase\ListSecondaryEmotions\ListSecondaryEmotions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ListSecondaryEmotionsController extends AbstractController
{
    #[Route(path: '/emotions/secondary', name: 'list_secondary_emotions', methods: 'GET')]
    public function __invoke(
        Request $request,
        ListSecondaryEmotions $useCase
    ) {
        $request->attributes->set('serialization_groups', ['Emotion:List']);
        return $useCase();
    }
}