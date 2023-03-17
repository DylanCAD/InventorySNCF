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
            'label'=> "CP du Cheminot",
            'class' => Cpchemin::class,
            'choice_label' => 'nomcpchemin'

        ])    
        
            ->add('nomCputilisateur',TextType::class,[
            'label'=> "CP de l'Utilisateur",
            'attr'=>[
                "placeholder"=>"Saisir le CP de l'Utilisateur"
            ]
        ])      

        ->add('datecputilisateur', DateType::class,[
            'label'=> "Date d'Aujourd'hui",
            'attr'=>[
                "placeholder"=>"Saisir la date d'aujourd'hui"
            ]
        ])

        ->add('idprodtel', TextType::class,[
            'label'=> "ID du Tel",
            'attr'=>[
                "placeholder"=>"Saisir le ID du Téléphone/Ipad"
            ]
        ])

        ->add('idprodobjet', TextType::class,[
            'label'=> "ID du Matériel Informatique",
            'attr'=>[
                "placeholder"=>"Saisir le ID du Matériel Informatique"
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
