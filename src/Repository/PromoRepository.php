<?php

namespace App\Repository;

use App\Entity\Promo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Promo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promo[]    findAll()
 * @method Promo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promo::class);
    }

    // /**
    //  * @return Promo[] Returns an array of Promo objects
    //  */
    
    public function getRefPromoApp()
    {
        $query= $this->createQueryBuilder('p')
            ->select("p,r,g,a")
            ->leftJoin('p.reference','r')
            ->leftJoin('p.groupe','g')
            ->andWhere('g.type =:typ')
            ->setParameter('typ', 'principal')
            ->leftJoin('g.apprenants','a')
            ->andWhere('a.attente = :val')
            ->setParameter('val', 0)
            ->getQuery()
            ->getResult()
        ;
        return $query;
    }
    

    public function getAppPromoattent()
    {
        $query= $this->createQueryBuilder('p')
            ->select("p,r,g,a")
            ->leftJoin('p.reference','r')
            ->leftJoin('p.groupe','g')
            ->andWhere('g.type =:typ')
            ->setParameter('typ', 'principal')
            ->leftJoin('g.apprenants','a')
            ->getQuery()
            ->getResult()
        ;
        
        return $query;
    }
    public function getonePromoPrincipal($id)
    {
        $query= $this->createQueryBuilder('p')
            ->select("p,r,g,a")
            ->andWhere('p.id =:idpromo')
            ->setParameter('idpromo', $id)
            ->leftJoin('p.reference','r')
            ->leftJoin('p.groupe','g')
            ->andWhere('g.type =:typ')
            ->setParameter('typ', 'principal')
            ->leftJoin('g.apprenants','a')
            ->getQuery()
            ->getResult()
        ;
         
        return $query;
    }
    // public function getonePromoReferentiel($id)
    // {
    //     $query= $this->createQueryBuilder('p')
    //         ->select("p,r,gc,c")
    //         ->andWhere('p.idpromo =:id')
    //         ->setParameter('id', $id)
    //         ->leftJoin('p.reference','r')
    //         ->leftJoin('r.groupecompetences','gc')
    //         ->leftJoin('gc.competences','c')
            
    //         ->getQuery()
    //         ->getResult()
    //     ;
    //     return $query;
//      }
 }

