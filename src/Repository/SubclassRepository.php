<?php

namespace App\Repository;

use App\Entity\Subclass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subclass|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subclass|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subclass[]    findAll()
 * @method Subclass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubclassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subclass::class);
    }

    /* @return Subclass[] Returns an array of subclass objects
    */    
    public function findAllOrdered()
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = '
                SELECT s.id, s.name, s.description, s.id_source, r.label as source_label, s.page, c.name as class_name 
                FROM subclass s
                    LEFT JOIN classe c ON c.id = s.id_class
                    LEFT JOIN source r ON r.id = s.id_source
                ORDER BY c.name, s.name
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* @return Subclass[] Returns an array of subclass objects of class $idClass
    */    
    public function findByIdClassOrdered($idClass)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = '
                SELECT s.id, s.name, s.description, s.id_source, r.label as source_label, r.name as source_name, s.page, c.name as class_name 
                FROM subclass s
                    LEFT JOIN classe c ON c.id = s.id_class
                    LEFT JOIN source r ON r.id = s.id_source
                WHERE s.id_class = ?
                ORDER BY c.name, s.name
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($idClass));
        return $stmt->fetchAll();
    }

    // /**
    //  * @return Subclass[] Returns an array of Subclass objects
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
    public function findOneBySomeField($value): ?Subclass
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
