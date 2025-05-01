<?php

namespace App\Security\User\Infrastructure\API\Controller\CreateUser;

use App\Security\User\Application\UseCase\CreateUser\CreateUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class CreateUserController extends AbstractController
{
    #[Route(path: '/user', name: 'create_user', methods: ['POST'], format: 'json')]
    public function __invoke(
        Request $request,
        #[MapRequestPayload] CreateUserInput $dto,
        CreateUser $useCase,
    ) {
        $request->attributes->set('serialization_groups', ['User:Read']);
        return $useCase($dto->toRequest()); //Si c'est une ApplicationError, traité par Symfony, comme ça je n'ai qu'a géré le cas ou cela a fonctionné
    }
}