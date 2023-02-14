<?php

namespace App\Controller\Admin;

use App\Entity\Cputilisateur;
use App\Form\CputilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CputilisateurRepository;
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
    public function listeCputilisateurs(CputilisateurRepository $repo)
    {
        $cputilisateurs=$repo->findAll();
        return $this->render('admin/cputilisateur/listeCputilisateurs.html.twig', [
            'lesCputilisateurs' => $cputilisateurs
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
}
