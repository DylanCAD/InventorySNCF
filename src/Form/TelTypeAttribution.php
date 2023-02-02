<?php

namespace App\Form;

use App\Entity\Tel;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Appareil;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TelTypeAttribution extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('cpUsers', TextType::class,[
                'label'=> "CP de l'utilisateur",
                'attr'=>[
                    "placeholder"=>"Saisir le CP de l'utilisateur"
                ]
            ])

            ->add('cpCheminaux', TextType::class,[
                'label'=> "CP du cheminaux",
                'attr'=>[
                    "placeholder"=>"Saisir le CP du cheminaux"
                ]
            ])

            ->add('libelleTel', TextType::class,[
                'label'=> "Libelle du tel",
                'attr'=>[
                    "placeholder"=>"Saisir le libelle du tel"
                ]
            ])

            ->add('lastModifTel', DateType::class,[
                'label'=> "Date du tel",
                'attr'=>[
                    "placeholder"=>"Saisir la date du tel"
                ]
            ])

            ->add('numSerie', TextType::class,[
                'label'=> "Num serie du tel",
                'attr'=>[
                    "placeholder"=>"Saisir le numero serie du tel"
                ]
            ])

            ->add('appareil', EntityType::class, [ 
                'label'=> "Genre de l'appareil",
                'class' => Appareil::class,
                'choice_label' => 'genreappareil'
            ])
            ->add('marque', EntityType::class, [ 
                'label'=> "Nom de la marque",
                'class' => Marque::class,
                'choice_label' => 'nommarque'
            ])
            ->add('modele', EntityType::class, [ 
                'label'=> "Nom du modele",
                'class' => Modele::class,
                'choice_label' => 'nommodele'
            ])
            //->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tel::class,
        ]);
    }
}
