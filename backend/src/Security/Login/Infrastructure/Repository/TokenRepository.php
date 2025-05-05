<?php

namespace App\Security\Login\Infrastructure\Repository;

use App\Security\Login\Application\Repository\{
    ReadTokenRepositoryInterface,
    WriteTokenRepositoryInterface
};
use App\Security\Login\Domain\Model\Token as ModelToken;
use App\Security\Login\Infrastructure\Doctrine\Entity\Token;
use App\Security\User\Infrastructure\Repository\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Token>
 */
class TokenRepository extends ServiceEntityRepository implements ReadTokenRepositoryInterface, WriteTokenRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private UserRepository $userRepository)
    {
        parent::__construct($registry, Token::class);
    }

    public function add(ModelToken $token): void
    {
        $token = Token::fromModel(
            token: $token,
            user: $this->userRepository->findOneById($token->getUserId())
        );

        $this->getEntityManager()->persist($token);
        $this->getEntityManager()->flush();
    }

    public function delete(ModelToken $token): void
    {

        $entity = $this->getEntityManager()->getRepository(Token::class)->findOneByToken($token->getToken());
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function findOneByUserId(int $userId): ?ModelToken
    {
        $result = $this->createQueryBuilder('t')
            ->select(['u', 't'])
            ->InnerJoin('t.user', 'u')
            ->andWhere('u.id = :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
            ->getOneOrNullResult();

        return $result?->toDomain();
    }

    //    /**
    //     * @return Token[] Returns an array of Token objects
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

    //    public function findOneBySomeField($value): ?Token
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
