<?php

namespace App\Repository;

use App\Entity\LikesMemory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LikesMemory|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikesMemory|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikesMemory[]    findAll()
 * @method LikesMemory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikesMemoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikesMemory::class);
    }

    // /**
    //  * @return LikesMemory[] Returns an array of LikesMemory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LikesMemory
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
