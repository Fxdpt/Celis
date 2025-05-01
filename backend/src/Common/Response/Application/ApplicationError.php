<?php

namespace App\Common\Response\Application;

final readonly class ApplicationError
{
    public function __construct(private ErrorCodeEnum $code, private string $message)
    {
    }

    public function getCode(): ErrorCodeEnum
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}