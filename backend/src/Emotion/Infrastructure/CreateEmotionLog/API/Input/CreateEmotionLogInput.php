<?php

namespace App\Emotion\Infrastructure\CreateEmotionLog\API\Input;

use App\Common\Symfony\Constraint\Timestamp\Timestamp;
use App\Emotion\Application\UseCase\CreateEmotionLog\CreateEmotionLogRequest;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateEmotionLogInput
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public int $primaryEmotionId,
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public int $secondaryEmotionId,
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public int $tertiaryEmotionId,
        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[Timestamp]
        public int $date,
        #[Assert\NotBlank]
        #[Assert\Length(max: 4294967295)]
        public ?string $comment,
        #[Assert\NotBlank]
        #[Assert\Length(max: 255)]
        public ?string $triggerEvent
    ) {
    }

    public function toRequest(): CreateEmotionLogRequest
    {
        return new CreateEmotionLogRequest(
            primaryEmotionId: $this->primaryEmotionId,
            secondaryEmotionId: $this->secondaryEmotionId,
            tertiaryEmotionId: $this->tertiaryEmotionId,
            date: \DateTimeImmutable::createFromTimestamp($this->date),
            comment: $this->comment,
            triggerEvent: $this->triggerEvent
        );
    }
}