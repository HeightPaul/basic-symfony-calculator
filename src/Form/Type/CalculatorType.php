<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Calculator;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstNumber', NumberType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    Calculator::PLUS => Calculator::PLUS,
                    Calculator::MINUS => Calculator::MINUS,
                    Calculator::MULTIPLICATION => Calculator::MULTIPLICATION,
                    Calculator::DIVISION => Calculator::DIVISION,
                ],
            ])
            ->add('secondNumber', NumberType::class)
            ->add('calculate', SubmitType::class, [
                // 'attr' => ['class' => 'test'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calculator::class,
        ]);
    }
}
