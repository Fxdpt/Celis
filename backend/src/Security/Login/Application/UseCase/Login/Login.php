<?php

namespace App\Security\Login\Application\UseCase\Login;

use App\Common\Response\Application\ApplicationError;
use App\Common\Response\Application\ErrorCodeEnum;
use App\Security\Login\Application\Repository\{
    ReadTokenRepositoryInterface,
    WriteTokenRepositoryInterface
};
use App\Security\Login\Domain\Model\Token;

final class Login
{
    public function __construct(
        private readonly WriteTokenRepositoryInterface $writeRepository,
        private readonly ReadTokenRepositoryInterface $readTokenRepository
    ) {
    }

    public function __invoke(LoginRequest $request): Token|ApplicationError
    {
        try {
            // Check if user already has a token and its not expired, if so, return it.
            $token = $this->readTokenRepository->findOneByUserId($request->userId);

            if ($token !== null) {
                if (! $token->isExpired()) {
                    return $token;
                }

                $this->writeRepository->delete($token);
            }

            $date = new \DateTimeImmutable('+2 hours');
            $token = new Token(
                userId: $request->userId,
                token: md5(random_bytes(10)),
                expirationDate: $date
            );
            $this->writeRepository->add($token);

            return $token;
        } catch (\Throwable $ex) {
            return new ApplicationError(ErrorCodeEnum::UNCONTROLLED_ERROR, $ex->getMessage());
        }
    }
}