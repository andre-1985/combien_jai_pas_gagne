<?php

namespace App\Form;

use App\Entity\SelectionEuromillions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GridEuromillionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ballsSelectionEuromillions', ChoiceType::class, [
                'choices' => array_combine(range(1, 50), range(1, 50)),
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('starsSelection', ChoiceType::class, [
                'choices' => array_combine(range(1, 12), range(1, 12)),
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('validate', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SelectionEuromillions::class,
        ]);
    }
}
