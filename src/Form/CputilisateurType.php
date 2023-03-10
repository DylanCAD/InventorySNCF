<?php

namespace App\Form;

use App\Entity\Cpchemin;
use App\Entity\Cputilisateur;
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

class CputilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('Cpchemin',EntityType::class, [ 
            'label'=> "CP cheminaux",
            'class' => Cpchemin::class,
            'choice_label' => 'nomcpchemin'

        ])    
        
            ->add('nomCputilisateur',TextType::class,[
            'label'=> "CP",
            'attr'=>[
                "placeholder"=>"Saisir le cp"
            ]
        ])      

        ->add('datecputilisateur', DateType::class,[
            'label'=> "Date d'aujourd'hui",
            'attr'=>[
                "placeholder"=>"Saisir la date d'aujourd'hui"
            ]
        ])

        ->add('idprodtel', TextType::class,[
            'label'=> "ID du tel",
            'attr'=>[
                "placeholder"=>"Saisir le ID du tel"
            ]
        ])

        ->add('idprodobjet', TextType::class,[
            'label'=> "ID de l'objet",
            'attr'=>[
                "placeholder"=>"Saisir le ID de l'objet"
            ]
        ])
        
        ;


    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cputilisateur::class,
        ]);
    }
}
