<?php

namespace App\Security\Login\Application\Repository;

use App\Security\Login\Domain\Model\Token;

interface ReadTokenRepositoryInterface
{
    public function findOneByUserId(int $userId): ?Token;
}
