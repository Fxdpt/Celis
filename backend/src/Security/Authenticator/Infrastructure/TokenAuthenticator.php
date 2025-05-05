<?php

namespace App\Security\Authenticator\Infrastructure;

use App\Security\Login\Infrastructure\Repository\TokenRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

final class TokenAuthenticator extends AbstractAuthenticator
{
    public const TOKEN_HEADER = 'Celis-Token';

    public function __construct(private readonly TokenRepository $tokenRepository)
    {
    }

    public function supports(Request $request): ?bool
    {
        if (
            $request->getPathInfo() === "/login"
            || ($request->getPathInfo() === "/user"
                && $request->getMethod() === "POST"
            )
        ) {
            $request->attributes->set('_security_skip_authenticator', true);
            return false;
        }

        return $request->headers->has(self::TOKEN_HEADER);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get(self::TOKEN_HEADER);
        if ($apiToken === null) {
            throw new CustomUserMessageAuthenticationException('No API Token Provided');
        }

        $token = $this->tokenRepository->findOneByToken($apiToken);

        if ($token === null) {
            throw new CustomUserMessageAuthenticationException('No API Token found');
        }

        if ($token->toDomain()->isExpired()) {
            $this->tokenRepository->delete($token);
            throw new CustomUserMessageAuthenticationException('Token Expired');
        }

        return new SelfValidatingPassport(new UserBadge($token->getUser()->getEmail()));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            'message' => 'Fail to authenticate user with given token'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }


}