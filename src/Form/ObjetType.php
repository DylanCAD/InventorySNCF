<?php

namespace App\Form;

use App\Entity\Objet;
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

class ObjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('libelleObjet', TextType::class,[
                'label'=> "Libelle du Matériel Informatique",
                'attr'=>[
                    "placeholder"=>"Saisir le libelle du Matériel Infortique"
                ]
            ])
            ->add('lastModifObjet', DateType::class,[
                'label'=> "Date d'ajout du Matériel Infortique",
                'attr'=>[
                    "placeholder"=>"Saisir la date d'ajout du matériel infortique"
                ]
            ])
            ->add('quantiteObjet', NumberType::class,[
                'label'=> "Quantité du Matériel Infortique",
                'attr'=>[
                    "placeholder"=>"Saisir la quantite du Matériel Informatique"
                ]
            ])
            ->add('appareil', EntityType::class, [ 
                'label'=> "Genre de l'Appareil",
                'class' => Appareil::class,
                'choice_label' => 'genreappareil'
            ])
            ->add('marque', EntityType::class, [ 
                'label'=> "Nom de la Marque",
                'class' => Marque::class,
                'choice_label' => 'nommarque'
            ])
            ->add('modele', EntityType::class, [ 
                'label'=> "Nom du Modele",
                'class' => Modele::class,
                'choice_label' => 'nommodele'
            ])

            ->add('numSerieObjet', TextType::class,[
                'label'=> "Numméro de Serie",
                'attr'=>[
                    "placeholder"=>"Saisir le Numéro de Série"
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
