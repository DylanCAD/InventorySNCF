<?php

namespace App\Controller\Utilisateur;

use App\Entity\Objet;
use App\Form\ObjetType;
use App\Repository\ObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObjetControllerUtili extends AbstractController
{
    /**
     * @Route("/utilisateur/objets", name="utilisateur_objets", methods={"GET"})
     */
    public function listeObjets(ObjetRepository $repo)
    {
        $objets=$repo->findAll();
        return $this->render('utilisateur/objet/listeObjetsUtil.html.twig', [
            'lesObjets' => $objets
        ]);
    }

    /**
     * @Route("/utilisateur/objet/ajout", name="utilisateur_objet_ajout", methods={"GET","POST"})
     * @Route("/utilisateur/objet/modif/{id}", name="utilisateur_objet_modif", methods={"GET","POST"})
     */
    public function ajoutModifObjet(Objet $objet=null, Request $request, EntityManagerInterface $manager)
    {
        if($objet == null){
            $objet=new Objet();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }
        $form=$this->createForm(ObjetType::class, $objet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($objet);
            $manager->flush();
            $this->addFlash("success","L'objet a bien été $mode");
            return $this->redirectToRoute('utilisateur_objets');
        }
        return $this->render('utilisateur/objet/formAjoutModifObjetUtil.html.twig', [
            'formObjet' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/utilisateur/objet/suppression/{id}", name="utilisateur_objet_suppression", methods={"GET"})
     */
    public function suppressionObjet(Objet $objet, EntityManagerInterface $manager)
    {
        $manager->remove($objet);
        $manager->flush();
        $this->addFlash("success","L'objet a bien été supprimé");
        return $this->redirectToRoute('utilisateur_objets');
    }
}
