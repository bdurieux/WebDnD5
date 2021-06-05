<?php

namespace App\Repository;

use App\Entity\Setting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Setting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Setting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Setting[]    findAll()
 * @method Setting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SettingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Setting::class);
    }

    /* @return Setting[] Returns an array of setting objects
    */    
    public function findForExistingSubclassByIdClass($idClass)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = '
                SELECT DISTINCT t.id, t.name 
                FROM `setting` t 
                    INNER JOIN dd_source r ON t.id = r.id_setting 
                    INNER JOIN subclass s ON s.id_source = r.id 
                WHERE s.id_class = ?
                ORDER BY t.name
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($idClass));
        return $stmt->fetchAll();
    }

    // /**
    //  * @return Setting[] Returns an array of Setting objects
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
    public function findOneBySomeField($value): ?Setting
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
