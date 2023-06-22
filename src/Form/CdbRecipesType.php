<?php

namespace App\Form;

use App\Entity\CdbRecipes;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CdbRecipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('title');
        $builder->add('description');
        $builder->add('time_days', ChoiceType::class, [
            'label' => 'Préparation - jours (optionnel)',
            'choices' => [
                '1 jour' => '1',
                '2 jours' => '2',
                '3 jours' => '3',
                '4 jours' => '4',
                '5 jours' => '5',
                '6 jours' => '6',
                '7 jours' => '7',
                '8 jours' => '8',
                '9 jours' => '9',
                '10 jours' => '10',
                '11 jours' => '11',
                '12 jours' => '12',
                '13 jours' => '13',
                '14 jours' => '14',
                '15 jours' => '15',
                '16 jours' => '16',
                '17 jours' => '17',
                '18 jours' => '18',
                '19 jours' => '19',
                '20 jours' => '20',
                '21 jours' => '21',
                '22 jours' => '22',
                '23 jours' => '23',
                '24 jours' => '24',
                '25 jours' => '25',
                '26 jours' => '26',
                '27 jours' => '27',
                '28 jours' => '28',
                '29 jours' => '29',
                '30 jours' => '30',
            ],
            'attr' => [
                'class' => 'form-control mb-4',
                'id' => 'time_hours',
                'name' => '_time_hours',
                'aria-label' => 'time_hours',
            ],
            'label_attr' => ['class' => 'form-label text-black'],
            'required' => false,
        ]);
        $builder->add('time_hours', ChoiceType::class, [
            'label' => 'Préparation - heures (optionnel)',
            'choices' => [
                '1 heure' => '1',
                '2 heures' => '2',
                '3 heures' => '3',
                '4 heures' => '4',
                '5 heures' => '5',
                '6 heures' => '6',
                '7 heures' => '7',
                '8 heures' => '8',
                '9 heures' => '9',
                '10 heures' => '10',
                '11 heures' => '11',
                '12 heures' => '12',
                '13 heures' => '13',
                '14 heures' => '14',
                '15 heures' => '15',
                '16 heures' => '16',
                '17 heures' => '17',
                '18 heures' => '18',
                '19 heures' => '19',
                '20 heures' => '20',
                '21 heures' => '21',
                '22 heures' => '22',
                '23 heures' => '23',
            ],
            'attr' => [
                'class' => 'form-control mb-4',
                'id' => 'time_hours',
                'name' => '_time_hours',
                'aria-label' => 'time_hours',
            ],
            'label_attr' => ['class' => 'form-label text-black'],
            'required' => false,
        ]);
        $builder->add('time_minutes', ChoiceType::class, [
            'label' => 'Préparation - minutes',
            'choices' => [
                '1 minute' => '1',
                '2 minutes' => '2',
                '3 minutes' => '3',
                '4 minutes' => '4',
                '5 minutes' => '5',
                '6 minutes' => '6',
                '7 minutes' => '7',
                '8 minutes' => '8',
                '9 minutes' => '9',
                '10 minutes' => '10',
                '11 minutes' => '11',
                '12 minutes' => '12',
                '13 minutes' => '13',
                '14 minutes' => '14',
                '15 minutes' => '15',
                '16 minutes' => '16',
                '17 minutes' => '17',
                '18 minutes' => '18',
                '19 minutes' => '19',
                '20 minutes' => '20',
                '21 minutes' => '21',
                '22 minutes' => '22',
                '23 minutes' => '23',
                '24 minutes' => '24',
                '25 minutes' => '25',
                '26 minutes' => '26',
                '27 minutes' => '27',
                '28 minutes' => '28',
                '29 minutes' => '29',
                '30 minutes' => '30',
                '31 minutes' => '31',
                '32 minutes' => '32',
                '33 minutes' => '33',
                '34 minutes' => '34',
                '35 minutes' => '35',
                '36 minutes' => '36',
                '37 minutes' => '37',
                '38 minutes' => '38',
                '39 minutes' => '39',
                '40 minutes' => '40',
                '41 minutes' => '41',
                '42 minutes' => '42',
                '43 minutes' => '43',
                '44 minutes' => '44',
                '45 minutes' => '45',
                '46 minutes' => '46',
                '47 minutes' => '47',
                '48 minutes' => '48',
                '49 minutes' => '49',
                '50 minutes' => '50',
                '51 minutes' => '51',
                '52 minutes' => '52',
                '53 minutes' => '53',
                '54 minutes' => '54',
                '55 minutes' => '55',
                '56 minutes' => '56',
                '57 minutes' => '57',
                '58 minutes' => '58',
                '59 minutes' => '59',
            ],
            'attr' => [
                'class' => 'form-control mb-4',
                'id' => 'time_minutes',
                'name' => '_time_minutes',
                'aria-label' => 'time_minutes',
            ],
            'label_attr' => ['class' => 'form-label text-black'],
        ]);
        $builder->add('difficulty', ChoiceType::class, [
            'label' => 'Difficulté',
            'choices' => [
                'Facile' => 'Facile',
                'Moyen' => 'Moyen',
                'Difficile' => 'Difficile',
            ],
            'attr' => [
                'class' => 'form-control mb-4',
                'id' => 'difficulty',
                'name' => '_difficulty',
                'aria-label' => 'difficulty',
            ],
            'label_attr' => ['class' => 'form-label text-black'],
        ]);
        $builder->add('pricing', ChoiceType::class, [
            'label' => 'Prix',
            'choices' => [
                'Pas cher' => 'Pas cher',
                'Moyen' => 'Moyen',
                'Cher' => 'Cher',
            ],
            'attr' => [
                'class' => 'form-control mb-4',
                'id' => 'pricing',
                'name' => '_pricing',
                'aria-label' => 'pricing',
            ],
            'label_attr' => ['class' => 'form-label text-black'],
        ]);
        $builder->add('content', CKEditorType::class);
        $builder->add('image', FileType::class, [
            'label' => 'Image',

            // unmapped means that this field is not associated to any entity property
            'mapped' => false,

            // make it optional so you don't have to re-upload the image file
            // every time you edit the item
            'required' => false,

            // unmapped fields can't define their validation using annotations
            // in the associated entity, so you can use the PHP constraint classes
            'constraints' => [
                new File([
                    'maxSize' => '2048k',
                    'mimeTypes' => [
                        'image/jpg',
                        'image/jpeg',
                        'image/png',
                    ],
                    'mimeTypesMessage' => 'Image non valide, veuillez choisir une image valide',
                ])
            ],
        ]);
        // $builder->add('created_at');
        // $builder->add('created_by');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CdbRecipes::class,
        ]);
    }
}
