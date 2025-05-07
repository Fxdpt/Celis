<?php

namespace App\Emotion\Infrastructure\Repository;

use App\Emotion\Application\Repository\ReadSecondaryEmotionRepositoryInterface;
use App\Emotion\Infrastructure\Doctrine\Entity\SecondaryEmotion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SecondaryEmotion>
 */
class SecondaryEmotionRepository extends ServiceEntityRepository implements ReadSecondaryEmotionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SecondaryEmotion::class);
    }

    public function findAll(): array
    {
        $results = parent::findAll();

        return array_map(
            fn(SecondaryEmotion $emotion) => $emotion->toModel(),
            $results
        );
    }

    //    /**
    //     * @return SecondaryEmotion[] Returns an array of SecondaryEmotion objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SecondaryEmotion
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
