<?php

namespace App\Common\Symfony\Constraint\Timestamp;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class TimestampValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        if (! $constraint instanceof Timestamp) {
            throw new UnexpectedTypeException($constraint, Timestamp::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (! is_int($value)) {
            throw new UnexpectedValueException($value, 'int');
        }

        try {
            \DateTimeImmutable::createFromTimestamp($value);
        } catch(\Throwable) {
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ timestamp }}', $value)
            ->addViolation();
        }
    }
}