<?php

namespace App\Security\User\Infrastructure\Adapter;

use App\Security\User\Application\Port\PasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class SymfonyPasswordHasherAdapter implements PasswordHasherInterface
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function hash(string $plainPassword): string
    {
        $dummyUser = new class implements \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface {
            public function getPassword(): ?string { return null; }
        };

        return $this->hasher->hashPassword($dummyUser, $plainPassword);
    }
}