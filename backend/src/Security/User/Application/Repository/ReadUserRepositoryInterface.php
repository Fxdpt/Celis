<?php

namespace App\Security\User\Application\Repository;

interface ReadUserRepositoryInterface
{
    public function existsByEmail(string $email): bool;
}