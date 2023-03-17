<?php

namespace App\Controller\Admin;

use App\Entity\Tel;
use App\Form\TelType;
use App\Model\FiltreTel;
use App\Form\FiltreTelType;
use App\Entity\Cputilisateur;
use App\Form\CputilisateurType;
use App\Form\TelAttributionType;
use App\Repository\TelRepository;
use App\Repository\ObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TelController extends AbstractController
{

        /**
     * @Route("/admin/tel/{id}/augmenter-quantite", name="admin_tels_increase_quantite")
     */    
    public function increaseQuantite(Tel $tel): RedirectResponse
    {
        $tel->increaseQuantite();
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('admin_tels');
    }


    /**
     * @Route("/admin/tel/{id}/diminuer-quantite", name="admin_tels_decrease_quantite")
     * @Route("/admin/cputilisateur/ajout", name="admin_cputilisateur_ajout", methods={"GET","POST"})
     */

    public function decreaseQuantite(Tel $tel=null, Request $request, EntityManagerInterface $manager)
    {
        
        $cputilisateur=new Cputilisateur();
        $form=$this->createForm(CputilisateurType::class, $cputilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $tel->decreaseQuantite();
            $this->getDoctrine()->getManager()->flush();
            $manager->persist($cputilisateur);
            $manager->flush();
            return $this->redirectToRoute('admin_cputilisateurs');
        }
        return $this->render('admin/cputilisateur/formAjoutCputilisateur.html.twig', [
            'formCputilisateur' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/tels", name="admin_tels", methods={"GET"})
     */
    public function listeTels(TelRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $filtre=new FiltreTel();
        $formFiltreTel=$this->createForm(FiltreTelType::class, $filtre);
        $formFiltreTel->handleRequest($request);
        //dd($filtre);
        $tels = $paginator->paginate(
        $repo->listeTelsCompletePaginee($filtre),
        $request->query->getInt('page', 1), 9
        );
        return $this->render('admin/tel/listeTels.html.twig', [
            'lesTels' => $tels,
            'formFiltreTel'=>$formFiltreTel->createView()
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
            $this->addFlash("success","Le Tel/Ipad a bien été $mode");
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
        $this->addFlash("success","Le Tel/Ipad a bien été supprimé");
        return $this->redirectToRoute('admin_tels');
    }
}
