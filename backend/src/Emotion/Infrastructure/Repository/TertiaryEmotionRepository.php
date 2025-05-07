<?php

namespace App\Emotion\Infrastructure\Repository;

use App\Emotion\Application\Repository\ReadTertiaryEmotionRepositoryInterface;
use App\Emotion\Infrastructure\Doctrine\Entity\TertiaryEmotion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TertiaryEmotion>
 */
class TertiaryEmotionRepository extends ServiceEntityRepository implements ReadTertiaryEmotionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TertiaryEmotion::class);
    }

    public function findAll(): array
    {
        $results = parent::findAll();

        return array_map(
            fn(TertiaryEmotion $emotion) => $emotion->toModel(),
            $results
        );
    }

    //    /**
    //     * @return TertiaryEmotion[] Returns an array of TertiaryEmotion objects
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

    //    public function findOneBySomeField($value): ?TertiaryEmotion
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
