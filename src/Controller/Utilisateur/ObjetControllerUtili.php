<?php

namespace App\Controller\Utilisateur;

use App\Entity\Objet;
use App\Form\ObjetType;
use App\Model\FiltreObjet;
use App\Entity\Cputilisateur;
use App\Form\FiltreObjetType;
use App\Form\CputilisateurType;
use App\Repository\ObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ObjetControllerUtili extends AbstractController
{
    /**
     * @Route("/utilisateur/objet/{id}/augmenter-quantite", name="objet_increase_quantite")
     */    
    public function increaseQuantite(Objet $objet): RedirectResponse
    {
        $objet->increaseQuantite();
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('utilisateur_objets');
    }


    /**
     * @Route("/utilisateur/objet/{id}/diminuer-quantite", name="objet_decrease_quantite")
     * @Route("/admin/cputilisateur/ajout", name="admin_cputilisateur_ajout", methods={"GET","POST"})
     */
    public function decreaseQuantite( Request $request, EntityManagerInterface $manager, Objet $objet)
    {

        $cputilisateur=new Cputilisateur();
        $form=$this->createForm(CputilisateurType::class, $cputilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $objet->decreaseQuantite();
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
     * @Route("/utilisateur/objets", name="utilisateur_objets", methods={"GET"})
     */
    public function listeObjets(ObjetRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $filtre=new FiltreObjet();
        $formFiltreObjet=$this->createForm(FiltreObjetType::class, $filtre);
        $formFiltreObjet->handleRequest($request);
        //dd($filtre);
        $objets = $paginator->paginate(
        $repo->listeObjetsCompletePaginee($filtre),
        $request->query->getInt('page', 1), 9
        );
        return $this->render('utilisateur/objet/listeObjetsUtil.html.twig', [
            'lesObjets' => $objets,
            'formFiltreObjet'=>$formFiltreObjet->createView()
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
            $this->addFlash("success","Le Matériel Informatique a bien été $mode");
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
        $this->addFlash("success","Le Matériel Informatique a bien été supprimé");
        return $this->redirectToRoute('utilisateur_objets');
    }
}
