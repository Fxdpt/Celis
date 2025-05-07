<?php

namespace App\Emotion\Infrastructure\ListTertiaryEmotions\API\Controller;

use App\Emotion\Application\UseCase\ListTertiaryEmotions\ListTertiaryEmotions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ListTertiaryEmotionsController extends AbstractController
{
    #[Route(path: '/emotions/tertiary', name: 'list_tertiary_emotions', methods: 'GET')]
    public function __invoke(
        Request $request,
        ListTertiaryEmotions $useCase
    ) {
        $request->attributes->set('serialization_groups', ['Emotion:List']);
        return $useCase();
    }
}