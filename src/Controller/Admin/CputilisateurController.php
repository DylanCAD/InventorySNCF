<?php

namespace App\Controller\Admin;

use App\Entity\Cputilisateur;
use App\Form\CputilisateurType;
use App\Model\FiltreCputilisateur;
use App\Form\FiltreCputilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CputilisateurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CputilisateurController extends AbstractController
{
    
    /**
     * @Route("/admin/cputilisateurs", name="admin_cputilisateurs", methods={"GET"})
     */
    public function listeCputilisateurs(CputilisateurRepository $repo, PaginatorInterface $paginator, Request $request)
    {
      
        $filtre=new FiltreCputilisateur();
        $formFiltreCputilisateur=$this->createForm(FiltreCputilisateurType::class, $filtre);
        $formFiltreCputilisateur->handleRequest($request);
        //dd($filtre);
        $cputilisateurs = $paginator->paginate(
        $repo->listeCputilisateursCompletePaginee($filtre)
        );
        return $this->render('admin/cputilisateur/listeCputilisateurs.html.twig', [
            
            $cputilisateurs = $this->getDoctrine()->getRepository(Cputilisateur::class)->findBy([],['datecputilisateur' => 'desc']),
            'lesCputilisateurs' => $cputilisateurs,
            'formFiltreCputilisateur'=>$formFiltreCputilisateur->createView()
        ]);
        
    }


    /**
     * @Route("/admin/cputilisateur/ajout", name="admin_cputilisateur_ajout", methods={"GET","POST"})
     */
    public function ajoutCputilisateur( Request $request, EntityManagerInterface $manager)
    {
        $cputilisateur=new Cputilisateur();
        $form=$this->createForm(CputilisateurType::class, $cputilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($cputilisateur);
            $manager->flush();
            return $this->redirectToRoute('admin_cputilisateurs');
        }
        return $this->render('admin/cputilisateur/formAjoutCputilisateur.html.twig', [
            'formCputilisateur' => $form->createView()
        ]);

    }

     /**
     * @Route("/admin/cputilisateur/suppression/{id}", name="admin_cputilisateur_suppression", methods={"GET"})
     */
    public function suppressionCputilisateur(Cputilisateur $cputilisateur, EntityManagerInterface $manager)
    {
        $manager->remove($cputilisateur);
        $manager->flush();
        $this->addFlash("success","L'attribution a bien été supprimé");
        return $this->redirectToRoute('admin_cputilisateurs');
    }
}
