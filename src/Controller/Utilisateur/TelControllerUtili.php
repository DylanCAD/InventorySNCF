<?php

namespace App\Controller\Utilisateur;

use App\Entity\Tel;
use App\Form\TelType;
use App\Repository\TelRepository;
use App\Repository\ObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TelControllerUtili extends AbstractController
{

    /**
     * @Route("/utilisateur/tel/{id}/augmenter-quantite", name="tel_increase_quantite")
     */    
    public function increaseQuantite(Tel $tel): RedirectResponse
    {
        $tel->increaseQuantite();
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('utilisateur_tels');
    }


    /**
     * @Route("/utilisateur/tel/{id}/diminuer-quantite", name="tel_decrease_quantite")
     */
    public function decreaseQuantite(Tel $tel): RedirectResponse
    {
        $tel->decreaseQuantite();
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('utilisateur_tels');
    }
    
    /**
     * @Route("/utilisateur/tels", name="utilisateur_tels", methods={"GET"})
     */
    public function listeTels(TelRepository $repo)
    {
        $tels=$repo->findAll();
        return $this->render('utilisateur/tel/listeTelsUtil.html.twig', [
            'lesTels' => $tels
        ]);
    }

    /**
     * @Route("/utilisateur/tel/ajout", name="utilisateur_tel_ajout", methods={"GET","POST"})
     * @Route("/utilisateur/tel/modif/{id}", name="utilisateur_tel_modif", methods={"GET","POST"})
     */
    public function ajoutModifTel(Tel $tel=null, Request $request, EntityManagerInterface $manager)
    {
        if($tel == null){
            $tel=new Tel();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }
        $form=$this->createForm(TelType::class, $tel);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($tel);
            $manager->flush();
            $this->addFlash("success","Le tel a bien été $mode");
            return $this->redirectToRoute('utilisateur_tels');
        }
        return $this->render('utilisateur/tel/formAjoutModifTelUtil.html.twig', [
            'formTel' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/utilisateur/tel/suppression/{id}", name="utilisateur_tel_suppression", methods={"GET"})
     */
    public function suppressionTel(Tel $tel, EntityManagerInterface $manager)
    {
        $manager->remove($tel);
        $manager->flush();
        $this->addFlash("success","Le tel a bien été supprimé");
        return $this->redirectToRoute('utilisateur_tels');
    }
}
