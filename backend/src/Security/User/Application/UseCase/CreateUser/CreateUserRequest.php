<?php

namespace App\Security\User\Application\UseCase\CreateUser;

final class CreateUserRequest
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password
    ) {
    }
}