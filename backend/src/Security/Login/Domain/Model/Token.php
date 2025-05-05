<?php

namespace App\Security\Login\Domain\Model;

final readonly class Token
{
    public function __construct(
        private int $userId,
        private string $token,
        private \DateTimeImmutable $expirationDate
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExpirationDate(): \DateTimeImmutable
    {
        return $this->expirationDate;
    }

    public function isExpired(): bool
    {
        return $this->expirationDate->getTimestamp() < new \DateTimeImmutable()->getTimestamp();
    }
}