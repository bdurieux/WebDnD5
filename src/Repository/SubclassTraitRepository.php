<?php

namespace App\Repository;

use App\Entity\SubclassTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubclassTrait|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubclassTrait|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubclassTrait[]    findAll()
 * @method SubclassTrait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubclassTraitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubclassTrait::class);
    }

    /* @return SubclassTrait[] Returns an array of subclassTrait objects
    */    
    public function findAllOrdered()
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = '
                SELECT t.id, t.name, t.description, t.level, t.id_subclass, s.name as subclass_name, c.name as class_name
                FROM subclass_trait t
                    LEFT JOIN subclass s ON s.id = t.id_subclass
                    LEFT JOIN classe c ON c.id = s.id_class
                ORDER BY c.name, s.name, t.level
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /**
    //  * @return SubclassTrait[] Returns an array of SubclassTrait objects
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
    public function findOneBySomeField($value): ?SubclassTrait
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
