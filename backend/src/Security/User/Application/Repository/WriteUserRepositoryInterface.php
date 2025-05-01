<?php

namespace App\Security\User\Application\Repository;

use App\Security\User\Domain\Model\User;

interface WriteUserRepositoryInterface
{
    public function add(User $user): int;
}