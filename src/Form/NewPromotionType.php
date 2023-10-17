<?php

namespace App\Form;

use App\Entity\Promotion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Range;

class NewPromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateType::class, [
                'label' => 'Date de début de la promo : ',
                'widget'  => 'single_text',
                'attr' => [
                    'data-form-type' => 'date'
                ]
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'Date de fin de la promo : ',
                'widget' => 'single_text'
            ])
            ->add('pourcentageRemise', IntegerType::class, [
                'label' => 'Pourcentage de remise : ',
                'attr' => [
                    'min' => '1',
                    'max' => '100'
                ]
                /*new PositiveOrZero([
                    'message' => 'ok'
                ]),
                /*new Range([
                    'min' => 0,
                    'max' => 100,
                    'notInRangeMessage' => 'Veuillez appliquer un promotion entre {{ min }} et {{ max }} %'
                ])*/
            ])
            ->add('productID', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
