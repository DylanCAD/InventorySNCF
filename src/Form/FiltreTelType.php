<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Appareil;
use App\Model\FiltreTel;
use App\Model\FiltreObjet;
use App\Repository\MarqueRepository;
use App\Repository\ModeleRepository;
use App\Repository\AppareilRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FiltreTelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr'=>[
                    'placeholder'=>"Saisir une partie du libelle du tel recherché"
                ],
                'required'=>false,
                'label'=>"Recherche sur le nom du tel"
            ])

            ->add('appareil', EntityType::class, [ 
                'class' => Appareil::class,
                'query_builder'=>function(AppareilRepository $repo){
                    return $repo->listeAppareilSimple();
                },
                'choice_label' => 'genreAppareil',
                'label'=>"Nom de l'appareil",
                'required'=>false
            ])

            ->add('marque', EntityType::class, [ 
                'class' => Marque::class,
                'query_builder'=>function(MarqueRepository $repo){
                    return $repo->listeMarqueSimple();
                },
                'choice_label' => 'nomMarque',
                'label'=>"Nom de la marque",
                'required'=>false
            ])

            ->add('modele', EntityType::class, [ 
                'class' => Modele::class,
                'query_builder'=>function(ModeleRepository $repo){
                    return $repo->listeModeleSimple();
                },
                'choice_label' => 'nomModele',
                'label'=>"Nom du modele",
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'method'=>'get',
            'csrf_protection'=>false,
            'data_class'=> FiltreTel::class
        ]);
    }
}
