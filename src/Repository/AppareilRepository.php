<?php

namespace App\Repository;

use App\Entity\Appareil;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Appareil>
 *
 * @method Appareil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appareil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appareil[]    findAll()
 * @method Appareil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppareilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appareil::class);
    }

    public function add(Appareil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Appareil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Appareil[] Returns an array of Appareil objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

/**
 * @return QueryBuilder Returns a QueryBuilder
 */
    public function listeAppareilSimple():QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.genreAppareil','ASC')
        ;
    }
}
