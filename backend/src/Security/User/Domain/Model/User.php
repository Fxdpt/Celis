<?php

namespace App\Security\User\Domain\Model;

final class User
{
    public function __construct(
        private ?int $id,
        private string $username,
        private string $password,
        private string $email,
        private array $roles = []
    ) {
    }

    public function setId(int $id): static
    {
        $this->id =$id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
         return $this->roles;
    }
}