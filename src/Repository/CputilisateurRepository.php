<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Cputilisateur;
use App\Model\FiltreCputilisateur;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Cputilisateur>
 *
 * @method Cputilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cputilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cputilisateur[]    findAll()
 * @method Cputilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CputilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cputilisateur::class);
    }

    public function add(Cputilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cputilisateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
   
    
    /**
     * @return Cputilisateur[] Returns an array of Objet objects
     */

     public function listeCputilisateursCompletePaginee(FiltreCputilisateur $filtre=null): ?Query
     {
         $query= $this->createQueryBuilder('cp')
             ->select('cp')
             ->orderBy('cp.id', 'ASC');
             
             if(!empty($filtre->idprodtel)){
                 $query->andWhere('cp.idprodtel like :idprodtelcherche')
                 ->setParameter('idprodtelcherche', "%{$filtre->idprodtel}%");
             }
             if(!empty($filtre->idprodobjet)){
                $query->andWhere('cp.idprodobjet like :idprodobjetcherche')
                ->setParameter('idprodobjetcherche', "%{$filtre->idprodobjet}%");
             }
             if(!empty($filtre->cpchemin)){
                 $query->andWhere('cp.Cpchemin = :cpchemincherche')
                 ->setParameter('cpchemincherche', $filtre->cpchemin);
             }

         ;
         return $query->getQuery();
     }

//    public function findOneBySomeField($value): ?Cputilisateur
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
