<?php

namespace App\Security\Login\Application\Repository;

use App\Security\Login\Domain\Model\Token;

interface WriteTokenRepositoryInterface
{
    /**
     * Add a token.
     *
     * @param Token $token
     */
    public function add(Token $token): void;

    public function delete(Token $token): void;
}