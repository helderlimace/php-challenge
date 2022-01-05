<?php

namespace App\Repository;

use App\Entity\Solicitation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Solicitation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Solicitation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Solicitation[]    findAll()
 * @method Solicitation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SolicitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Solicitation::class);
    }

    // /**
    //  * @return Solicitation[] Returns an array of Solicitation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Solicitation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
