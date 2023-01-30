<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use Symfony\Component\Validator\Constraints as Assert;

class UserPasswordType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            // ------------------------------------------- PASSWORD
            ->add('plainPassword', PasswordType::class, [
                // 'mapped'=> true,
                    'label' => 'Ancien mot de passe',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Votre mot de passe actuel',
                    ],
                    'label_attr' => [
                        'class' => 'form-label mt-2'
                    ],
                    'constraints' => [new Assert\NotBlank()],
            ])
            ->add('newPassword', RepeatedType::class, [
                'type'=> PasswordType::class,
                'mapped'=>false,
                'first_options' => [
                    'label' => 'Nouveau mot de passe',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Votre mot de passe',
                    ],
                    'label_attr' => [
                        'class' => 'form-label mt-2'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation du nouveau mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-2'
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Confirmez votre mot de passe',
                    ],
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'constraints' => [new Assert\NotBlank()],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-dark my-4',
                ],
                'label' => 'Changer mon mot de passe',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
