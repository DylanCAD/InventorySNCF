<?php

namespace App\Repository;

use App\Entity\Objet;
use Doctrine\ORM\Query;
use App\Model\FiltreObjet;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Objet>
 *
 * @method Objet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objet[]    findAll()
 * @method Objet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objet::class);
    }

    public function add(Objet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Objet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Objet[] Returns an array of Objet objects
     */

    public function listeObjetsCompletePaginee(FiltreObjet $filtre=null): ?Query
    {
        $query= $this->createQueryBuilder('o')
            ->select('o')
            ->orderBy('o.id', 'ASC');
            if(!empty($filtre->nom)){
                $query->andWhere('o.libelle_Objet like :nomcherche')
                ->setParameter('nomcherche', "%{$filtre->nom}%");
            }
            if(!empty($filtre->appareil)){
                $query->andWhere('o.Appareil = :appareilcherche')
                ->setParameter('appareilcherche', $filtre->appareil);
            }
            if(!empty($filtre->marque)){
                $query->andWhere('o.Marque = :marquecherche')
                ->setParameter('marquecherche', $filtre->marque);
            }
            if(!empty($filtre->modele)){
                $query->andWhere('o.Modele = :modelecherche')
                ->setParameter('modelecherche', $filtre->modele);
            }
        ;
        return $query->getQuery();
    }

//    public function findOneBySomeField($value): ?Objet
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
