<?php

namespace App\Controller\Admin;

use App\Entity\Objet;
use App\Form\ObjetType;
use App\Repository\ObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObjetController extends AbstractController
{

    /**
     * @Route("/admin/objet/{id}/augmenter-quantite", name="admin_objets_increase_quantite")
     */    
    public function increaseQuantite(Objet $objet): RedirectResponse
    {
        $objet->increaseQuantite();
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('admin_objets');
    }


    /**
     * @Route("/admin/objet/{id}/diminuer-quantite", name="admin_objets_decrease_quantite")
     */
    public function decreaseQuantite(Objet $objet): RedirectResponse
    {
        $objet->decreaseQuantite();
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('admin_objets');
    }

    /**
     * @Route("/admin/objets", name="admin_objets", methods={"GET"})
     */
    public function listeObjets(ObjetRepository $repo)
    {
        $objets=$repo->findAll();
        return $this->render('admin/objet/listeObjets.html.twig', [
            'lesObjets' => $objets
        ]);
    }

    /**
     * @Route("/admin/objet/ajout", name="admin_objet_ajout", methods={"GET","POST"})
     * @Route("/admin/objet/modif/{id}", name="admin_objet_modif", methods={"GET","POST"})
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
            return $this->redirectToRoute('admin_objets');
        }
        return $this->render('admin/objet/formAjoutModifObjet.html.twig', [
            'formObjet' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/admin/objet/suppression/{id}", name="admin_objet_suppression", methods={"GET"})
     */
    public function suppressionObjet(Objet $objet, EntityManagerInterface $manager)
    {
        $manager->remove($objet);
        $manager->flush();
        $this->addFlash("success","L'objet a bien été supprimé");
        return $this->redirectToRoute('admin_objets');
    }
}
