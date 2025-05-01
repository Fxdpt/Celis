<?php

namespace App\Security\User\Application\UseCase\CreateUser;

use App\Security\User\Application\Exception\UserException;
use App\Security\User\Application\Repository\ReadUserRepositoryInterface;

final class CreateUserValidator
{
    public function __construct(private readonly ReadUserRepositoryInterface $readRepository)
    {
    }

    public function validateEmailIsNotAlreadyUsed(string $email): void
    {
        if ($this->readRepository->existsByEmail($email)) {
            throw UserException::userAlreadyExists();
        }
    }
}