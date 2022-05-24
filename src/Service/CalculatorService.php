<?php

namespace App\Service;

use App\Entity\Calculator;
use App\Service\Calculation\TypeCalculationFactory;
use App\Form\FormErrorHandler\CalculatorFormErrorHandler;
use ArithmeticError;
use Symfony\Component\Form\Form;

class CalculatorService
{
    private Calculator $calculator;
    private TypeCalculationFactory $typeCalculationFactory;
    private CalculatorFormErrorHandler $calculatorFormErrorHandler;
    private Form $form;

    public function __construct(
        Calculator $calculator,
        TypeCalculationFactory $typeCalculationFactory,
        CalculatorFormErrorHandler $calculatorFormErrorHandler
    ) {
        $this->calculator = $calculator;
        $this->typeCalculationFactory = $typeCalculationFactory;
        $this->calculatorFormErrorHandler = $calculatorFormErrorHandler;
    }

    public function postConstruct(Form $form): void
    {
        $this->form = $form;
    }

    public function getCalculationWithForm(Form $form): array
    {
        $this->postConstruct($form);
        $calculation = null;
        try {
            $typeCalculation = $this->typeCalculationFactory->create($this->calculator->getType());
            $calculation = $typeCalculation->get($this->calculator);
        } catch (ArithmeticError $exception) {
            $this->calculatorFormErrorHandler->setErrorMessage($this->form, $exception);
        }

        return [$calculation, $this->form];
    }
}
