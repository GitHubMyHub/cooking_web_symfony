<?php

namespace App\Repository;

use App\Entity\Food;
use App\Entity\Likes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Food|null find($id, $lockMode = null, $lockVersion = null)
 * @method Food|null findOneBy(array $criteria, array $orderBy = null)
 * @method Food[]    findAll()
 * @method Food[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Food::class);
    }

    /**
     * @return Food[] Returns newest Food objects
     */

    public function findNewestFoods()
    {
        return $this->createQueryBuilder('f')
            ->orderBy('f.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Food[] Returns Food objects by Name
     */

    public function findByNameOffset($value, $limit = null, $offset = null)
    {
        return $this->createQueryBuilder('f')
            ->select('f.id, f.name, f.description, f.description2, 
                      f.duration, f.pictureName, f.creationDate, 
                      f.category, f.visible, l.foodId, l.foodLike')
            ->leftJoin(Likes::class, 'l', 'WITH', 'f.id = l.foodId')
            ->where('f.name LIKE :val')
            ->andWhere('f.visible = 1')
            ->setParameter('val', '%' . $value . '%')
            ->orderBy('f.id', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Food[] Returns Food objects
     */

    public function findFoods($value)
    {
        return $this->createQueryBuilder('f')
            ->select('f.id, f.name')
            ->where('f.name LIKE :val')
            ->setParameter('val', $value . '%')
            ->orderBy('f.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Food Returns a single Food item by Id
     */

    public function findFoodItem($value)
    {

        /*
            SELECT f.id, f.name, f.description, f.description2, 
                   f.duration, f.picture_name, f.creation_date, 
                   f.category, f.visible, l.food_id, l.food_like 
                   FROM `food` as f 
                   left join likes as l 
                   ON f.id = l.food_id 
                   WHERE f.id = 8
        */
        //dump($value);die;
        return $this->createQueryBuilder('f')
            ->select('f.id, f.name, f.description, f.description2, 
                      f.duration, f.pictureName, f.creationDate, 
                      f.category, f.visible, l.foodId, l.foodLike')
            ->leftJoin(Likes::class, 'l', 'WITH', 'f.id = l.foodId')
            ->where('f.visible = 1')
            ->andWhere('f.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()[0]
            ;
    }



    /**
     * @return Food[] Returns Food objects by criteria
     */

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null){

        //dump($criteria);die;
        //dump(isset($criteria["category"]));die;

        if(isset($criteria["category"])){

            return $this->createQueryBuilder('f')
                ->select('f.id, f.name, f.description, f.description2, 
                         f.duration, f.pictureName, f.creationDate, 
                         f.category, f.visible, l.foodId, l.foodLike')
                ->leftJoin(Likes::class, 'l', 'WITH', 'f.id = l.foodId')
                ->where('f.visible = :val1 and f.category = :val2')
                ->setParameter('val1', $criteria["visible"])
                ->setParameter('val2', $criteria["category"])
                ->orderBy('f.id', 'DESC')
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult()
                ;
        } else {
            return $this->createQueryBuilder('f')
                ->select('f.id, f.name, f.description, f.description2, 
                         f.duration, f.pictureName, f.creationDate, 
                         f.category, f.visible, l.foodId, l.foodLike')
                ->leftJoin(Likes::class, 'l', 'WITH', 'f.id = l.foodId')
                ->where('f.visible = :val1')
                ->setParameter('val1', $criteria["visible"])
                ->orderBy('f.id', 'DESC')
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult()
                ;
        }
        
    }
    
    /**
     * @return Food[] Returns Food objects by offset and limit
     */

    public function findAllByOffset(array $criteria, array $orderBy = null, $limit = null, $offset = null){

        //dump($criteria);die;
        
        return $this->createQueryBuilder('f')
            ->select('f.id, f.name, f.description, f.description2, 
                     f.duration, f.pictureName, f.creationDate, 
                     f.category, f.visible, l.foodId, l.foodLike')
            ->leftJoin(Likes::class, 'l', 'WITH', 'f.id = l.foodId')
            ->orderBy('f.id', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Food
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
