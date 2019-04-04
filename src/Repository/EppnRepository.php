<?php

namespace App\Repository;

use App\Entity\Eppn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Eppn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eppn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eppn[]    findAll()
 * @method Eppn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EppnRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Eppn::class);
    }


	
    public function findEppn($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.eppn = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Eppn
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
