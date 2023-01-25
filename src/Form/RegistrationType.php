<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            // -------------------------------------------------- PRENOM
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                    'placeholder' => 'Veuillez saisir votre prénom',
                ],
                'label' => 'Prenom',
                'label_attr' => [
                    'class' => 'form-label mt-5',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 2, 'max' => 50]),
                ],
            ])
            // -------------------------------------------------- LASTNAME
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                    'placeholder' => 'Veuillez saisir votre nom',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 2, 'max' => 50]),
                ],
            ])
            // --------------------------------------------------  EMAIL
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '180',
                    'placeholder' => 'Veuillez saisir votre adresse mail',
                ],
                'label' => 'Adresse mail',
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],

                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 180]),
                    new Assert\Email(),
                    new Assert\NotBlank(),
                ],
            ])
            // -------------------------------------------------- PSEUDO
            ->add('pseudo', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                    'placeholder' => 'Choisissez un pseudo',
                ],
                'label' => 'Pseudo (Falcultatif)',
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
                'constraints' => [new Assert\Length(['min' => 2, 'max' => 50])],
            ])
            // -------------------------------------------------- PASSWORD
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Votre mot de passe',
                    ],
                    'label_attr' => [
                        'class' => 'form-label mt-2'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-2'
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Confirmez votre mot de passe',
                    ],
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas',
            ])

            // -------------------------------------------------- SUBMIT
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary my-4',
                ],
                'label' => 'Valider',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
