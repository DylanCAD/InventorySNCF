<?php

namespace App\Controller\Admin;

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

class TelController extends AbstractController
{

        /**
     * @Route("/admin/tel/{id}/augmenter-quantite", name="tel_increase_quantite")
     */    
    public function increaseQuantite(Tel $tel): RedirectResponse
    {
        $tel->increaseQuantite();
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('admin_tels');
    }


    /**
     * @Route("/admin/tel/{id}/diminuer-quantite", name="tel_decrease_quantite")
     */
    public function decreaseQuantite(Tel $tel): RedirectResponse
    {
        $tel->decreaseQuantite();
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('admin_tels');
    }

    /**
     * @Route("/admin/tels", name="admin_tels", methods={"GET"})
     */
    public function listeTels(TelRepository $repo)
    {
        $tels=$repo->findAll();
        return $this->render('admin/tel/listeTels.html.twig', [
            'lesTels' => $tels
        ]);
    }

    /**
     * @Route("/admin/tel/ajout", name="admin_tel_ajout", methods={"GET","POST"})
     * @Route("/admin/tel/modif/{id}", name="admin_tel_modif", methods={"GET","POST"})
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
            return $this->redirectToRoute('admin_tels');
        }
        return $this->render('admin/tel/formAjoutModifTel.html.twig', [
            'formTel' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/admin/tel/suppression/{id}", name="admin_tel_suppression", methods={"GET"})
     */
    public function suppressionTel(Tel $tel, EntityManagerInterface $manager)
    {
        $manager->remove($tel);
        $manager->flush();
        $this->addFlash("success","Le tel a bien été supprimé");
        return $this->redirectToRoute('admin_tels');
    }
}
