<?php

namespace App\Emotion\Infrastructure\ListPrimaryEmotions\API\Controller;

use App\Emotion\Application\UseCase\ListPrimaryEmotions\ListPrimaryEmotions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ListPrimaryEmotionsController extends AbstractController
{
    #[Route(path: '/emotions/primary', name: 'list_primary_emotions', methods: 'GET')]
    public function __invoke(
        Request $request,
        ListPrimaryEmotions $useCase
    ) {
        $request->attributes->set('serialization_groups', ['Emotion:List']);
        return $useCase();
    }
}