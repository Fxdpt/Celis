<?php

namespace App\Security\User\Application\Port;

interface PasswordHasherInterface
{
    public function hash(string $plainPassword): string;
}