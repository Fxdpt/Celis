<?php

namespace App\Emotion\Infrastructure\Repository;

use App\Emotion\Application\Repository\ReadPrimaryEmotionRepositoryInterface;
use App\Emotion\Infrastructure\Doctrine\Entity\PrimaryEmotion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrimaryEmotion>
 */
class PrimaryEmotionRepository extends ServiceEntityRepository implements ReadPrimaryEmotionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrimaryEmotion::class);
    }

    public function findAll(): array
    {
        $results = parent::findAll();

        return array_map(
            fn(PrimaryEmotion $emotion) => $emotion->toModel(),
            $results
        );

    }

//    /**
//     * @return PrimaryEmotion[] Returns an array of PrimaryEmotion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PrimaryEmotion
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
