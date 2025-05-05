<?php

namespace App\Security\Login\Application\UseCase\Login;

final readonly class LoginRequest
{
    public function __construct(public int $userId)
    {
    }
}