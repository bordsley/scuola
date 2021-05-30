<?php

namespace App\Repository;

use App\Entity\BigliettoIndirizzo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BigliettoIndirizzo|null find($id, $lockMode = null, $lockVersion = null)
 * @method BigliettoIndirizzo|null findOneBy(array $criteria, array $orderBy = null)
 * @method BigliettoIndirizzo[]    findAll()
 * @method BigliettoIndirizzo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BigliettoIndirizzoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BigliettoIndirizzo::class);
    }

    // /**
    //  * @return BigliettoIndirizzo[] Returns an array of BigliettoIndirizzo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BigliettoIndirizzo
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
