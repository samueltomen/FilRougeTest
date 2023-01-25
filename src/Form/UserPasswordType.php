<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

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
                'label' => 'Mot de passe',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre mot de passe actuel',
                ],
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
            ])
            ->add('newPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez votre nouveau mot de passe',
                ],
                'label' => 'Nouveau mot de passe',
                'label_attr' => ['class' => 'form-label mt-4'],
                'constraints' => [new Assert\NotBlank()],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-dark my-4',
                ],
                'label' => 'Confirmer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
