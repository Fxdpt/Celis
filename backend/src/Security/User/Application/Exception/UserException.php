<?php

namespace App\Security\User\Application\Exception;

final class UserException extends \Exception
{
    public static function userAlreadyExists()
    {
        return new self('User already exists');
    }
}