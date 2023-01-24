<?php

namespace App\DataFixtures;

use App\Entity\Tel;
use App\Entity\Objet;
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
                    ->setInventaire($this->getReference("inventaire".$value[4]));

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
                    ->setInventaire($this->getReference("inventaire".$value[4]));

            $manager->persist($tel);
        }

        $manager->flush();
    }
}