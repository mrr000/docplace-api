<?php

namespace App\Repository;

use App\Entity\ProjectWorkListPosition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectWorkListPosition>
 *
 * @method ProjectWorkListPosition|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectWorkListPosition|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectWorkListPosition[]    findAll()
 * @method ProjectWorkListPosition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectWorkListPositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectWorkListPosition::class);
    }

    public function add(ProjectWorkListPosition $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProjectWorkListPosition $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProjectWorkListPosition[] Returns an array of ProjectWorkListPosition objects
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

//    public function findOneBySomeField($value): ?ProjectWorkListPosition
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
