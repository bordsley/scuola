<?php

namespace App\Repository;

use App\Entity\ContenutoMultimediale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContenutoMultimediale|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContenutoMultimediale|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContenutoMultimediale[]    findAll()
 * @method ContenutoMultimediale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenutoMultimedialeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContenutoMultimediale::class);
    }

    // /**
    //  * @return ContenutoMultimediale[] Returns an array of ContenutoMultimediale objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContenutoMultimediale
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
