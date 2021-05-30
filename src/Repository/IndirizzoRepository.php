<?php

namespace App\Repository;

use App\Entity\Indirizzo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Indirizzo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Indirizzo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Indirizzo[]    findAll()
 * @method Indirizzo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndirizzoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Indirizzo::class);
    }

    // /**
    //  * @return Indirizzo[] Returns an array of Indirizzo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Indirizzo
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
