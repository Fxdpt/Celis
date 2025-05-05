<?php

namespace App\Security\User\Infrastructure\Doctrine\Entity;

use App\Security\Login\Infrastructure\Doctrine\Entity\Token;
use App\Security\User\Domain\Model\User as ModelUser;
use App\Security\User\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Token $token = null;

    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id,
        #[ORM\Column(length: 180)]
        private string $email,
        #[ORM\Column(length: 255)]
        private string $username,
        #[ORM\Column]
        private array $roles = [],
        #[ORM\Column]
        private string $password
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function toDomain(): ModelUser
    {
        return new ModelUser(
            id: $this->id,
            username: $this->username,
            password: $this->password,
            email: $this->email,
            roles: $this->roles
        );
    }

    public static function fromModel(ModelUser $user): static
    {
        return new static(
            id: $user->getId(),
            username: $user->getUsername(),
            email: $user->getEmail(),
            roles: $user->getRoles(),
            password: $user->getPassword()
        );
    }

    public function getToken(): ?Token
    {
        return $this->token;
    }

    public function setToken(Token $token): static
    {
        // set the owning side of the relation if necessary
        if ($token->getUser() !== $this) {
            $token->setUser($this);
        }

        $this->token = $token;

        return $this;
    }
}
