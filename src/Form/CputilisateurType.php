<?php

namespace App\Form;

use App\Entity\Cpchemin;
use App\Entity\Cputilisateur;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
            'label'=> "Cp cheminaux",
            'class' => Cpchemin::class,
            'choice_label' => 'nomcpchemin'

        ])    
        
            ->add('nomCputilisateur',TextType::class,[
            'label'=> "Cp",
            'attr'=>[
                "placeholder"=>"Saisir le cp"
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
