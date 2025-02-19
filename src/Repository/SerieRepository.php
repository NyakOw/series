<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Serie>
 *
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function add(Serie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Serie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Recherher les meilleurs series en base de donnée
     * @return Serie[]
     */

    // TODO : INTERESSANT POUR CREER DU CRUD
    public function findBest(): Paginator{
        $qb = $this->createQueryBuilder('s');
            $qb->leftJoin('s.seasons', 'seasons')
                ->addSelect('seasons')
            ->where('s.popularity > 100')
            ->andWhere('s.vote > 8')
            ->orderBy('s.vote', 'DESC');
        $query = $qb->getQuery();
        $query->setMaxResults(200);

        return new Paginator($query);

//
//        $em = $this->getEntityManager();
//        $dql = "
//                SELECT  c
//                FROM App\Entity\Serie s
//                WHERE s.popularity> 100
//                AND s.vote> 8
//                ORDER BY s.popularity DESC
//                ";
//        $query = $em->createQuery($dql);
//        $query->setMaxResults(100);
//        $results = $query->getResult();
//
//        return $results;
    }

//    /**
//     * @return Serie[] Returns an array of Serie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Serie
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
