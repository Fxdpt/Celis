<?php

namespace App\Security\Login\Infrastructure\Doctrine\Entity;

use App\Security\Login\Domain\Model\Token as ModelToken;
use App\Security\Login\Infrastructure\Repository\TokenRepository;
use App\Security\User\Infrastructure\Doctrine\Entity\User;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TokenRepository::class)]
class Token
{

    public function __construct(
        #[ORM\OneToOne(inversedBy: 'token', cascade: ['persist'])]
        #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
        private ?User $user,
        #[ORM\Column(type: 'integer')]
        private int $expirationDate,
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null,
        #[ORM\Column(length: 255)]
        private ?string $token = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getExpirationDate(): int
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(int $expirationDate): static
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function toDomain(): ModelToken
    {
        return new ModelToken(
            $this->user->getId(),
            $this->token,
            (new \DateTimeImmutable())->setTimestamp($this->expirationDate)
        );
    }

    public static function fromModel(ModelToken $token, ?User $user = null): static
    {
        return new static(
            user: $user,
            token: $token->getToken(),
            expirationDate: $token->getExpirationDate()->getTimestamp()
        );
    }
}
