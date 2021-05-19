<?php

namespace App\Repository;

use App\Entity\Traduc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Traduc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Traduc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Traduc[]    findAll()
 * @method Traduc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraducRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Traduc::class);
    }

    // /**
    //  * @return Traduc[] Returns an array of Traduc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Traduc
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
