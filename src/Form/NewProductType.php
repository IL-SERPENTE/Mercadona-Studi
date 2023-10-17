<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
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
                'label' => 'Nom du produit : ',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Nom du produit'
                ]
            ])

            // Description du produit
            ->add('description', TextareaType::class, [
                'label' => 'Decription : ',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Description du produit...'
                ]
            ])

            // Prix du produit
            ->add('prix', NumberType::class, [
                'label' => 'Prox du produit : ',
                'constraints' => [
                    new NotNull([
                        'message' => 'Le prix du  produit ne peut être null',
                    ])

                ],
                'attr' => [
                    'placeholder' => 'Prix du produit'
                ]
            ])

            // Ajout d'une image pour le produit
            ->add('image', FileType::class, [
                'label' => 'Image du produit : ',
                'constraints' => [
                    /*new NotBlank([
                        'message' => 'Veuillez importer une image pour le produit'
                    ]),*/
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Seuls les fichiers { types } sont accepté !'
                    ])
                ],
            ])

            // Categorie du produit
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie du produit : ',
                'choices' => [
                    'Selectionnez une catégorie' => '',
                    'Alimentation' => 'Alimentation',
                    'Electronique' => 'Electronique',
                    'Vêtements et mode' => 'Vêtements et mode',
                    'Beauté et santé' => 'Beauté et santé',
                    'Sports et loisirs' => 'Sports et loisirs',
                    'Livres et papeterie' => 'Livres et papeterie'
                ]
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
