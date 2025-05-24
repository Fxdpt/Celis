<?php

namespace App\Emotion\Infrastructure\Repository;

use App\Emotion\Application\Repository\ReadTriggerEventRepositoryInterface;
use App\Emotion\Application\Repository\WriteTriggerEventRepositoryInterface;
use App\Emotion\Domain\Model\TriggerEvent as ModelTriggerEvent;
use App\Emotion\Infrastructure\Doctrine\Entity\TriggerEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TriggerEvent>
 */
class TriggerEventRepository extends ServiceEntityRepository implements ReadTriggerEventRepositoryInterface, WriteTriggerEventRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TriggerEvent::class);
    }

    public function findByName(string $name): ?ModelTriggerEvent
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t')
        ->from(TriggerEvent::class, 't')
        ->where('t.name = :name')
        ->setParameter('name', $name);

        $result = $qb->getQuery()->getOneOrNullResult();

        return $result?->toModel();
    }

    public function add(ModelTriggerEvent $triggerEvent): int
    {
        $triggerEvent = TriggerEvent::fromModel($triggerEvent);
        $this->getEntityManager()->persist($triggerEvent);
        $this->getEntityManager()->flush();

        return $triggerEvent->getId();
    }

    //    /**
    //     * @return TriggerEvent[] Returns an array of TriggerEvent objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TriggerEvent
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
