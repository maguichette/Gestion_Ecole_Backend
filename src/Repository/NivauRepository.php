<?php

namespace App\Repository;

use App\Entity\Nivau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nivau|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nivau|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nivau[]    findAll()
 * @method Nivau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NivauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nivau::class);
    }

    // /**
    //  * @return Nivau[] Returns an array of Nivau objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nivau
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
