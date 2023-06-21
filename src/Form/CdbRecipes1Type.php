<?php

namespace App\Form;

use App\Entity\CdbRecipes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CdbRecipes1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('content')
            ->add('time_hours')
            ->add('time_minutes')
            ->add('difficulty')
            ->add('pricing')
            ->add('created_at')
            ->add('image')
            ->add('created_by')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CdbRecipes::class,
        ]);
    }
}
