<?php

namespace App\Form;

use App\Entity\Tel;
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

class TelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

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
            ->add('quantiteTel', NumberType::class,[
                'label'=> "Quantite du tel",
                'attr'=>[
                    "placeholder"=>"Saisir la quantite du tel"
                ]
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
