<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('firstName', TextType::class, [
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
                'required' => false,
                'constraints' => [new Assert\Length(['min' => 2, 'max' => 50])],
            ])
            ->add('lastName', TextType::class, [
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
                'required' => false,
                'constraints' => [new Assert\Length(['min' => 2, 'max' => 50])],
            ])
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
                'required' => false,
                'constraints' => [new Assert\Length(['min' => 2, 'max' => 50])],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre mot de passe',
                ],
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
            ])
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
