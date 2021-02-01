<?php

namespace App\Repository;

use App\Entity\CreatureSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CreatureSize|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreatureSize|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreatureSize[]    findAll()
 * @method CreatureSize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatureSizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreatureSize::class);
    }

    // /**
    //  * @return CreatureSize[] Returns an array of CreatureSize objects
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
    public function findOneBySomeField($value): ?CreatureSize
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
