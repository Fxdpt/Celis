<?php

namespace App\Security\Login\Infrastructure\API\Controller\Login;

use App\Security\Login\Application\UseCase\Login\Login;
use App\Security\Login\Application\UseCase\Login\LoginRequest;
use App\Security\User\Infrastructure\Doctrine\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

final class LoginController extends AbstractController
{
    #[Route(path: '/login', name: 'login', methods: ['POST'])]
    public function __invoke(
        #[CurrentUser] ?User $user,
        Login $useCase
    ) {
        if ($user === null) {
            return $this->json(['message' => 'missing credentials'], Response::HTTP_UNAUTHORIZED);
        }

        return $useCase(new LoginRequest(userId: $user->getId()));
    }
}