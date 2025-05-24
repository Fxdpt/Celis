<?php

namespace App\Common\Symfony\Constraint\Timestamp;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
final class Timestamp extends Constraint
{
    public string $message = 'The value {{ timestamp }} is not a valid timestamp';
    public string $mode = 'strict';

    // all configurable options must be passed to the constructor
    public function __construct(?string $mode = null, ?string $message = null, ?array $groups = null, $payload = null)
    {
        parent::__construct([], $groups, $payload);

        $this->mode = $mode ?? $this->mode;
        $this->message = $message ?? $this->message;
    }
}