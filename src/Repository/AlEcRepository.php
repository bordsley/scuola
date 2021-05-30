<?php

namespace App\Repository;

use App\Entity\AlEc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AlEc|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlEc|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlEc[]    findAll()
 * @method AlEc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlEcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlEc::class);
    }

    // /**
    //  * @return AlEc[] Returns an array of AlEc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AlEc
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
