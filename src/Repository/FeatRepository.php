<?php

namespace App\Repository;

use App\Entity\Feat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Feat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feat[]    findAll()
 * @method Feat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feat::class);
    }

    /* @return Feat[] Returns an array of feat objects
    */    
    public function findAllJoined()
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = '
            SELECT f.id, f.name, f.prerequisite, f.description, s.label as source, page 
            FROM feat f 
                LEFT JOIN source s ON s.id = f.id_source
            GROUP BY f.name 
            ORDER BY f.name             
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /**
    //  * @return Alignment[] Returns an array of Alignment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alignment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
