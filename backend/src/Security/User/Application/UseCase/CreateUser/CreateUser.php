<?php

namespace App\Security\User\Application\UseCase\CreateUser;

use App\Common\Response\Application\ApplicationError;
use App\Common\Response\Application\ErrorCodeEnum;
use App\Security\User\Application\Exception\UserException;
use App\Security\User\Application\Port\PasswordHasherInterface;
use App\Security\User\Application\Repository\WriteUserRepositoryInterface;
use App\Security\User\Domain\Model\User;

final class CreateUser
{
    public function __construct(
        private readonly CreateUserValidator $validator,
        private readonly WriteUserRepositoryInterface $writeRepository,
        private readonly PasswordHasherInterface $passwordHasher
    ) {
    }

    public function __invoke(CreateUserRequest $request): User|ApplicationError
    {
        try {
            $this->validator->validateEmailIsNotAlreadyUsed($request->email);

            $user = new User(
                id: null,
                username: $request->username,
                password: $this->passwordHasher->hash($request->password),
                email: $request->email
            );

            $userId = $this->writeRepository->add($user);
        } catch (UserException $ex) {
            return new ApplicationError(
                code: ErrorCodeEnum::INVALID_REQUEST_ERROR,
                message: $ex->getMessage()
            );
        } catch (\Throwable $ex) {
            return new ApplicationError(
                code: ErrorCodeEnum::UNCONTROLLED_ERROR,
                message: 'An error occured while creating user'
            );
        }

        return $user->setId($userId);
    }
}