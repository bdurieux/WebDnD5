<?php

namespace App\Repository;

use App\Entity\ClasseOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClasseOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasseOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasseOption[]    findAll()
 * @method ClasseOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClasseOption::class);
    }

    /* @return ClasseOption[] Returns an array of classeOption objects
    */    
    public function findAllOrdered()
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = '
            SELECT o.id, o.name, o.description, o.level, o.id_class, c.name as class_name 
            FROM classe_option o
                LEFT JOIN classe c ON c.id = o.id_class 
            ORDER BY c.name, o.level, o.name
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /**
    //  * @return ClasseOption[] Returns an array of ClasseOption objects
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
    public function findOneBySomeField($value): ?ClasseOption
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
