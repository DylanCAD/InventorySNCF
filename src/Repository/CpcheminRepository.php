<?php

namespace App\Repository;

use App\Entity\Cpchemin;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Cpchemin>
 *
 * @method Cpchemin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cpchemin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cpchemin[]    findAll()
 * @method Cpchemin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CpcheminRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cpchemin::class);
    }

    public function add(Cpchemin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cpchemin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Cpchemin[] Returns an array of Cpchemin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

/**
 * @return QueryBuilder Returns a QueryBuilder
 */
public function listeCpcheminSimple():QueryBuilder
{
    return $this->createQueryBuilder('cpchemin')
        ->orderBy('cpchemin.nomCpchemin','ASC')
    ;
}
}
