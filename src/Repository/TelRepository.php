<?php

namespace App\Repository;

use App\Entity\Tel;
use Doctrine\ORM\Query;
use App\Model\FiltreTel;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Tel>
 *
 * @method Tel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tel[]    findAll()
 * @method Tel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tel::class);
    }

    public function add(Tel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

     /**
     * @return Tel[] Returns an array of Objet objects
     */

     public function listeTelsCompletePaginee(FiltreTel $filtre=null): ?Query
     {
         $query= $this->createQueryBuilder('t')
             ->select('t')
             ->orderBy('t.id', 'ASC');
             if(!empty($filtre->nom)){
                 $query->andWhere('t.libelle_Tel like :nomcherche')
                 ->setParameter('nomcherche', "%{$filtre->nom}%");
             }
             if(!empty($filtre->appareil)){
                 $query->andWhere('t.Appareil = :appareilcherche')
                 ->setParameter('appareilcherche', $filtre->appareil);
             }
             if(!empty($filtre->marque)){
                 $query->andWhere('t.Marque = :marquecherche')
                 ->setParameter('marquecherche', $filtre->marque);
             }
             if(!empty($filtre->modele)){
                 $query->andWhere('t.Modele = :modelecherche')
                 ->setParameter('modelecherche', $filtre->modele);
             }
         ;
         return $query->getQuery();
     }

//    /**
//     * @return Tel[] Returns an array of Tel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tel
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
