<?php

namespace App\Form;

use App\Entity\Projets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\File;

class ProjetsType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '5',
                    'maxlenght' => '100',
                ],
                'label' => 'Titre',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new Assert\Length(['min' => 5, 'max' => 50]),
                    new Assert\NotBlank(),
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Votre Image',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'mimeTypes' => [
                            'application/png',
                            'application/jpg',
                            'application/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PNG file',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-secondary mt-4'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projets::class,
        ]);
    }
}
