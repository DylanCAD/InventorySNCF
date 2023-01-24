<?php

namespace App\Form;

use App\Entity\Objet;
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

class ObjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('libelleObjet', TextType::class,[
                'label'=> "Libelle de l'objet",
                'attr'=>[
                    "placeholder"=>"Saisir le libelle de l'objet"
                ]
            ])
            ->add('lastModifObjet', DateType::class,[
                'label'=> "Date de l'objet",
                'attr'=>[
                    "placeholder"=>"Saisir la date de l'objet"
                ]
            ])
            ->add('quantiteObjet', NumberType::class,[
                'label'=> "Quantite de l'objet",
                'attr'=>[
                    "placeholder"=>"Saisir la quantite de l'objet"
                ]
            ])
            //->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objet::class,
        ]);
    }
}