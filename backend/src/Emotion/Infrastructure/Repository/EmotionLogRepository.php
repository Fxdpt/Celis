<?php

namespace App\Emotion\Infrastructure\Repository;

use App\Emotion\Application\Repository\WriteEmotionLogRepositoryInterface;
use App\Emotion\Domain\Model\EmotionLog as ModelEmotionLog;
use App\Emotion\Infrastructure\Doctrine\Entity\EmotionLog;
use App\Emotion\Infrastructure\Doctrine\Entity\PrimaryEmotion;
use App\Emotion\Infrastructure\Doctrine\Entity\SecondaryEmotion;
use App\Emotion\Infrastructure\Doctrine\Entity\TertiaryEmotion;
use App\Emotion\Infrastructure\Doctrine\Entity\TriggerEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmotionLog>
 */
class EmotionLogRepository extends ServiceEntityRepository implements WriteEmotionLogRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        private PrimaryEmotionRepository $primaryEmotionRepository,
        private SecondaryEmotionRepository $secondaryEmotionRepository,
        private TertiaryEmotionRepository $tertiaryEmotionRepository,
        private TriggerEventRepository $triggerEventRepository,
    ) {
        parent::__construct($registry, EmotionLog::class);
    }

    public function add(ModelEmotionLog $emotionLog): int
    {
        $primaryEmotionEntity = $this->primaryEmotionRepository->find($emotionLog->getPrimaryEmotion()->getId());
        $secondaryEmotionEntity = $this->secondaryEmotionRepository->find($emotionLog->getSecondaryEmotion()->getId());
        $tertiaryEmotionEntity = $this->tertiaryEmotionRepository->find($emotionLog->getTertiaryEmotion()->getId());
        $triggerEventEntity = $this->triggerEventRepository->find($emotionLog->getTriggerEvent()->getId());
        $emotionLog = $this->convertDomainToEntity(
            $emotionLog,
            $primaryEmotionEntity,
            $secondaryEmotionEntity,
            $tertiaryEmotionEntity,
            $triggerEventEntity
        );

        $this->getEntityManager()->persist($emotionLog);
        $this->getEntityManager()->flush($emotionLog);

        return $emotionLog->getId();
    }

    private function convertDomainToEntity(
        ModelEmotionLog $model,
        PrimaryEmotion $primaryEmotionEntity,
        SecondaryEmotion $secondaryEmotionEntity,
        TertiaryEmotion $tertiaryEmotionEntity,
        TriggerEvent $triggerEventEntity
    ): EmotionLog {
        return new EmotionLog(
            id: $model->getId(),
            date: $model->getDate()->getTimestamp(),
            primaryEmotion: $primaryEmotionEntity,
            secondaryEmotion: $secondaryEmotionEntity,
            tertiaryEmotion: $tertiaryEmotionEntity,
            comment: $model->getComment(),
            triggerEvent: $triggerEventEntity
        );
    }

    //    /**
    //     * @return EmotionLog[] Returns an array of EmotionLog objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EmotionLog
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
