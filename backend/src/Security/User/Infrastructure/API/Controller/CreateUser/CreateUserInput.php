<?php

namespace App\Security\User\Infrastructure\API\Controller\CreateUser;

use App\Security\User\Application\UseCase\CreateUser\CreateUserRequest;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\PasswordStrength;

final class CreateUserInput
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(max: 255)]
        public string $username,

        #[Assert\NotBlank]
        #[Assert\Email]
        #[Assert\Length(max: 180)]
        public string $email,

        #[Assert\PasswordStrength([
            'minScore' => PasswordStrength::STRENGTH_MEDIUM
        ])]
        #[Assert\Length(max: 255)]
        public string $password
    ) {}


    public function toRequest(): CreateUserRequest
    {
        return new CreateUserRequest(
            username: $this->username,
            email: $this->email,
            password: $this->password
        );
    }
}