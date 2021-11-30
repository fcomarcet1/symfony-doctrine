<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Query\ResultSetMappingBuilder;


/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineUserRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findOneById(string $id): ?User
    {
        return $this->objectRepository->find($id);
    }

    /*public function findOneByIdOrFail(string $id): User
    {
        if (null === $user = $this->objectRepository->find($id)) {
            throw UserNotFoundException::fromUserId($id);
        }

        return $user;
    }*/

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdWithQueryBuilder(string $id): ?User
    {
        $qb = $this->objectRepository->createQueryBuilder('u');
        $query = $qb
            ->where(
                $qb->expr()->eq('u.id', ':id')
            )
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getOneOrNullResult();
    }

    public function findOneByIdWithDQL(string $id): ?User
    {
        $query = $this->getEntityManager()->createQuery('SELECT u FROM App\Entity\User u WHERE u.id = :id');
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findOnyByIdWithNativeQuery(string $id): ?User
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata(User::class, 'u');

        $query = $this->getEntityManager()->createNativeQuery('SELECT * FROM user WHERE id = :id', $rsm);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findOneByIdWithPlainSQL(string $id): array
    {
        $params = [
            ':id' => $this->getEntityManager()->getConnection()->quote($id),
        ];
        $query = 'SELECT * FROM user WHERE id = :id';

        return $this->getEntityManager()->getConnection()->executeQuery(\strtr($query, $params))->fetchAllAssociative();
    }

    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    public function remove(User $user): void
    {
        $this->removeEntity($user);
    }

    public function refresh(User $user): void
    {
        $this->refreshEntity($user);
    }

}
