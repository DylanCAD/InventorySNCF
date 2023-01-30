<?php

namespace App\DataFixtures;

use App\Entity\Tel;
use App\Entity\Objet;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Appareil;
use App\Entity\Inventaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fichierInventaireCsv=fopen(__DIR__."/inventaire.csv","r");
        while (!feof($fichierInventaireCsv)) {
            $lesInventaires[]=fgetcsv($fichierInventaireCsv);
        }
        fclose($fichierInventaireCsv);
        
        foreach ($lesInventaires as $value) {
            $inventaire=new Inventaire();
            $inventaire ->setId(intval($value[0]))
                        ->setCathegorieInventaire($value[1]);
            $manager->persist($inventaire);
            $this->addReference("inventaire".$value[0],$inventaire);
        }

        $fichierAppareilCsv=fopen(__DIR__."/appareil.csv","r");
        while (!feof($fichierAppareilCsv)) {
            $lesAppareils[]=fgetcsv($fichierAppareilCsv);
        }
        fclose($fichierAppareilCsv);
        
        foreach ($lesAppareils as $value) {
            $appareil=new Appareil();
            $appareil   ->setId(intval($value[0]))
                        ->setGenreAppareil($value[1]);
            $manager->persist($appareil);
            $this->addReference("appareil".$value[0],$appareil);

        }

        $fichierMarqueCsv=fopen(__DIR__."/marque.csv","r");
        while (!feof($fichierMarqueCsv)) {
            $lesMarques[]=fgetcsv($fichierMarqueCsv);
        }
        fclose($fichierMarqueCsv);
        
        foreach ($lesMarques as $value) {
            $marque=new Marque();
            $marque   ->setId(intval($value[0]))
                      ->setNomMarque($value[1]);
            $manager->persist($marque);
            $this->addReference("marque".$value[0],$marque);

        }

        $fichierModeleCsv=fopen(__DIR__."/modele.csv","r");
        while (!feof($fichierModeleCsv)) {
            $lesModeles[]=fgetcsv($fichierModeleCsv);
        }
        fclose($fichierModeleCsv);
        
        foreach ($lesModeles as $value) {
            $modele=new Modele();
            $modele   ->setId(intval($value[0]))
                      ->setNomModele($value[1]);
            $manager->persist($modele);
            $this->addReference("modele".$value[0],$modele);

        }

        $fichierObjetCsv=fopen(__DIR__."/objet.csv","r");
        while (!feof($fichierObjetCsv)) {
            $lesObjets[]=fgetcsv($fichierObjetCsv);
        }
        fclose($fichierObjetCsv);
        
        foreach ($lesObjets as $value) {
            $objet=new Objet();
            $objet  ->setId(intval($value[0]))
                    ->setLibelleObjet($value[1])
                    ->setLastModifObjet(new \DateTime($value[2]))
                    ->setQuantiteObjet($value[3])
                    ->setInventaire($this->getReference("inventaire".$value[4]))
                    ->setAppareil($this->getReference("appareil".$value[5]))
                    ->setMarque($this->getReference("marque".$value[6]))
                    ->setModele($this->getReference("modele".$value[7]));

            $manager->persist($objet);
        }


        $fichierTelCsv=fopen(__DIR__."/tel.csv","r");
        while (!feof($fichierTelCsv)) {
            $lesTels[]=fgetcsv($fichierTelCsv);
        }
        fclose($fichierTelCsv);
        
        foreach ($lesTels as $value) {
            $tel=new Tel();
            $tel    ->setId(intval($value[0]))
                    ->setLibelleTel($value[1])
                    ->setLastModifTel(new \DateTime($value[2]))
                    ->setQuantiteTel($value[3])
                    ->setInventaire($this->getReference("inventaire".$value[4]))
                    ->setAppareil($this->getReference("appareil".$value[5]))
                    ->setMarque($this->getReference("marque".$value[6]))
                    ->setModele($this->getReference("modele".$value[7]));
            $manager->persist($tel);
        }



        $manager->flush();
    }
}