<?php

namespace App\Emotion\Application\UseCase\CreateEmotionLog;

use App\Common\Response\Application\ApplicationError;
use App\Common\Response\Application\ErrorCodeEnum;
use App\Common\Service\Interface\TransactionalSessionInterface;
use App\Emotion\Application\Exception\EmotionLogValidationException;
use App\Emotion\Application\Repository\ReadPrimaryEmotionRepositoryInterface;
use App\Emotion\Application\Repository\ReadSecondaryEmotionRepositoryInterface;
use App\Emotion\Application\Repository\ReadTertiaryEmotionRepositoryInterface;
use App\Emotion\Application\Repository\ReadTriggerEventRepositoryInterface;
use App\Emotion\Application\Repository\WriteEmotionLogRepositoryInterface;
use App\Emotion\Application\Repository\WriteTriggerEventRepositoryInterface;
use App\Emotion\Domain\Model\EmotionLog;
use App\Emotion\Domain\Model\TriggerEvent;


final class CreateEmotionLog
{
    public function __construct(
        private readonly EmotionLogValidator $validator,
        private readonly ReadTriggerEventRepositoryInterface $readTriggerEventRepository,
        private readonly WriteTriggerEventRepositoryInterface $writeTriggerEventRepository,
        private readonly ReadPrimaryEmotionRepositoryInterface $readPrimaryEmotionRepository,
        private readonly ReadSecondaryEmotionRepositoryInterface $readSecondaryEmotionRepository,
        private readonly ReadTertiaryEmotionRepositoryInterface $readTertiaryEmotionRepository,
        private readonly WriteEmotionLogRepositoryInterface $writeEmotionLogRepository,
        private readonly TransactionalSessionInterface $transactionalSession
    ) {
    }

    public function __invoke(CreateEmotionLogRequest $request): EmotionLog|ApplicationError
    {
        try {
            $this->validator->validateEmotionIds(
                $request->primaryEmotionId,
                $request->secondaryEmotionId,
                $request->tertiaryEmotionId
            );
            $this->validator->validateDateIsNotInFuture($request->date);
            if ($request->triggerEvent !== null) {
                $triggerEvent = $this->createTriggerEventIfNotExists($request->triggerEvent);
            }
            $primaryEmotion = $this->readPrimaryEmotionRepository->findOneById($request->primaryEmotionId);
            $secondaryEmotion = $this->readSecondaryEmotionRepository->findOneById($request->secondaryEmotionId);
            $tertiaryEmotion = $this->readTertiaryEmotionRepository->findOneById($request->tertiaryEmotionId);

            $emotionLog = new EmotionLog(
                id: null,
                primaryEmotion: $primaryEmotion,
                secondaryEmotion: $secondaryEmotion,
                tertiaryEmotion: $tertiaryEmotion,
                date: $request->date,
                comment: $request->comment,
                triggerEvent: $triggerEvent ?? $request->triggerEvent
            );

            $emotionLogId = $this->writeEmotionLogRepository->add($emotionLog);
            $emotionLog->setId($emotionLogId);

            return $emotionLog;
        } catch (EmotionLogValidationException $ex) {
            return new ApplicationError(ErrorCodeEnum::INVALID_REQUEST_ERROR, $ex->getMessage());
        } catch (\Throwable $ex) {
            return new ApplicationError(ErrorCodeEnum::UNCONTROLLED_ERROR, $ex->getMessage());
        }
    }

    private function createTriggerEventIfNotExists(string $triggerEvent): TriggerEvent
    {
        if(($existingTriggerEvent = $this->readTriggerEventRepository->findByName($triggerEvent)) !== null) {
            return $existingTriggerEvent;
        }

        $triggerEvent = new TriggerEvent(
            id: null,
            name: $triggerEvent,
            emotionLogs:[]
        );

        $triggerEventId = $this->writeTriggerEventRepository->add($triggerEvent);
        $triggerEvent->setId($triggerEventId);
        return $triggerEvent;
    }
}