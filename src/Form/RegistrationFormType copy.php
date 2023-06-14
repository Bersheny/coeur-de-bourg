<?php

namespace App\Form;

use App\Entity\TblUsers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un prénom.',
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Veuillez entrer au moins {{ limit }} caractère.',
                    ]),
                ],
            ])
            
            ->add('last_name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un nom.',
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Veuillez entrer au moins {{ limit }} caractère.',
                    ]),
                ],
            ])

            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse e-mail.',
                    ]),
                    new Email([
                        'message' => 'Veuillez entrer une adresse e-mail valide.',
                    ]),
                ],
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Modérateur' => 'ROLE_MODERATOR',
                ],
                'expanded' => true,
                'multiple' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un rôle.',
                    ]),
                    new Callback(function ($roles, ExecutionContextInterface $context) {
                        if (is_array($roles) && count($roles) > 1) {
                            $context->buildViolation('Vous ne pouvez sélectionner qu\'un seul rôle.')
                                ->addViolation();
                        }
                    }),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TblUsers::class,
            'multiple' => true,
        ]);
    }

    
}