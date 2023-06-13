<?php

namespace App\Form;

use App\Entity\TblNews;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class TblNewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('title');
        $builder->add('description');
        $builder->add('content', CKEditorType::class);
        $builder->add('image', FileType::class, [
            'label' => 'Image',

            // unmapped means that this field is not associated to any entity property
            'mapped' => false,

            // make it optional so you don't have to re-upload the PDF file
            // every time you edit the Product details
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
        $builder->add('startDateTime',  DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'input' => 'datetime_immutable',
        ]);
        $builder->add('endDateTime', DateType::class, [
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'input' => 'datetime_immutable',
        ]);
        // $builder->add('created_at');
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TblNews::class,
        ]);
    }
}
