<?php

namespace App\Service;

use App\Entity\Calculator;
use App\Form\FormErrorHandler;
use App\Service\TypeCalculation\TypeCalculationFactory;
use ArithmeticError;
use DivisionByZeroError;
use ReflectionClass;
use Symfony\Component\Form\Form;

class CalculatorService
{
    private array $entityConstants;
    private Calculator $calculator;
    private FormErrorHandler $formErrorHandler;
    private Form $form;

    public function __construct(Calculator $calculator, FormErrorHandler $formErrorHandler)
    {
        $this->calculator = $calculator;
        $this->formErrorHandler = $formErrorHandler;
        $this->entityConstants = (new ReflectionClass(Calculator::class))->getConstants();
    }

    public function postConstruct(Form $form)
    {
        $this->form = $form;
    }

    public function getCalculationWithForm(Form $form): array
    {
        $this->postConstruct($form);
        $calculation = null;
        try {
            if (in_array($this->calculator->getType(), $this->entityConstants)) {
                $typeCalculation = TypeCalculationFactory::create($this->entityConstants, $this->calculator->getType());
                $calculation = $typeCalculation->get($this->calculator);
            } else {
                throw new ArithmeticError('Missing calculation type');
            }
        } catch (ArithmeticError $exception) {
            $this->setErrorMessageByExceptionClass($exception);
        }

        return [$calculation, $this->form];
    }


    private function setErrorMessageByExceptionClass(ArithmeticError $exception): void
    {
        if ($exception instanceof DivisionByZeroError) {
            $this->formErrorHandler->setErrorMessage($this->form, $exception, 'secondNumber');
        } else {
            $this->formErrorHandler->setErrorMessage($this->form, $exception);
        }
    }
}
