<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class NewProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Libelle du produit
            ->add('libelle', TextType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide'
                    ])
                ]
            ])

            // Description du produit
            ->add('description', TextareaType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide'
                    ])
                ]
            ])

            // Prix du produit
            ->add('prix', NumberType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotNull([
                        'message' => 'Le prix du  produit ne peut être null'
                    ])

                ]
            ])

            // Ajout d'une image pour le produit
            ->add('image', FileType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotNull([
                        'message' => 'Veuillez importer une image pour le produit'
                    ]),
                    new Image([
                        'mimeTypes' => [
                            '.png'
                        ],
                        'mimeTypesMessage' => 'test'
                    ])
                ]
            ])

            // Categorie du produit
            ->add('categorie', TextType::class, [
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
