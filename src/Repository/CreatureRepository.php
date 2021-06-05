<?php

namespace App\Repository;

use App\Entity\Creature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Creature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Creature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Creature[]    findAll()
 * @method Creature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Creature::class);
    }


    /* @return Creature[] Returns an array of creature objects
    */    
    public function findAllJoined()
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = '
            SELECT c.id, z.name AS size, t.name AS type, c.name, c.challenge, a.label as alignment, s.label as source, page 
            FROM creature c 
                LEFT JOIN creature_size z ON z.id = c.id_size 
                LEFT JOIN creature_type t ON t.id = c.id_type 
                LEFT JOIN alignment a ON a.id = c.id_alignment 
                LEFT JOIN dd_source s ON s.id = c.id_source
            GROUP BY c.name 
            ORDER BY c.name             
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* @return Creature[] Returns an array of creature objects
    */    
    public function findAllwOption($types,$sources)
    {
        $sql_type = "";
        if(sizeof($types)>0){
            $sql_type = "?";
            if(sizeof($types)>0){
                for($i=1;$i<sizeof($types);$i++){
                    $sql_type .= ",?";
                }
            }
        }
        $sql_src = "";
        if(sizeof($sources)>0){
            $sql_src = "?";
            if(sizeof($sources)>0){
                for($i=1;$i<sizeof($sources);$i++){
                    $sql_src .= ",?";
                }
            }
        }
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = '
            SELECT c.id, z.name AS size, t.name AS type, c.name, c.challenge, a.label as alignment, s.label as source, page 
            FROM creature c 
                LEFT JOIN creature_size z ON z.id = c.id_size 
                LEFT JOIN creature_type t ON t.id = c.id_type 
                LEFT JOIN alignment a ON a.id = c.id_alignment 
                LEFT JOIN dd_source s ON s.id = c.id_source
            WHERE t.id IN (' . $sql_type . ') AND s.id IN (' . $sql_src . ')
            GROUP BY c.name 
            ORDER BY c.name             
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array_merge($types,$sources));
        return $stmt->fetchAll();
    }

    /* @return Creature[] Returns an array of creature objects
    */    
    public function findAllByType($idType)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = '
            SELECT c.id, z.name AS size, t.name AS type, c.name, c.challenge, a.label as alignment, s.label as source, page 
            FROM creature c 
                LEFT JOIN creature_size z ON z.id = c.id_size 
                LEFT JOIN creature_type t ON t.id = c.id_type 
                LEFT JOIN alignment a ON a.id = c.id_alignment 
                LEFT JOIN dd_source s ON s.id = c.id_source
            WHERE c.id_type = ?
            ORDER BY c.challenge, c.name
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($idType));
        return $stmt->fetchAll();
    }

    // /**
    //  * @return Creature[] Returns an array of Creature objects
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
    public function findOneBySomeField($value): ?Creature
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
