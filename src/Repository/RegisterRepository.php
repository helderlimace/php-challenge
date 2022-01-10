<?php

namespace App\Repository;

use App\Entity\Register;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Register|null find($id, $lockMode = null, $lockVersion = null)
 * @method Register|null findOneBy(array $criteria, array $orderBy = null)
 * @method Register[]    findAll()
 * @method Register[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegisterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Register::class);
    }

    // /**
    //  * @return Register[] Returns an array of Register objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Register
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findAll()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('select r.batch, r.id, r.input, r.key_found from register r');
        $result = $query->getResult();
        return $result;

    }*/
}
