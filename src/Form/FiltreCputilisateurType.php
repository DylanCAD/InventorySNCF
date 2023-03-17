<?php

namespace App\Form;

use App\Entity\Cpchemin;
use App\Entity\Cputilisateur;
use App\Model\FiltreCputilisateur;
use App\Repository\CpcheminRepository;
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

class FiltreCputilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('cpchemin', EntityType::class, [ 
            'class' => Cpchemin::class,
            'query_builder'=>function(CpcheminRepository $repo){
                return $repo->listeCpcheminSimple();
            },
            'choice_label' => 'nomCpchemin',
            'label'=>"CP du Cheminot",
            'required'=>false
        ])         

        ->add('idprodtel', TextType::class, [
            'attr'=>[
                'placeholder'=>"Saisir le ID du Téléphone/Ipad"
            ],
            'required'=>false,
            'label'=>"ID du Téléphone/Ipad"
        ])

        ->add('idprodobjet', TextType::class, [
            'attr'=>[
                'placeholder'=>"Saisir le ID du Matériel Informatique"
            ],
            'required'=>false,
            'label'=>"ID du Matériel Informatique"
        ])
        
        ;

    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'method'=>'get',
            'csrf_protection'=>false,
            'data_class'=> FiltreCputilisateur::class
        ]);
    }
}
