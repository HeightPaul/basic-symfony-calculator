<?php

namespace App\Service;

use App\Entity\Calculator;
use App\Form\FormErrorHandler;
use ArithmeticError;
use DivisionByZeroError;
use ReflectionClass;
use Symfony\Component\Form\Form;

class CalculatorService implements CalculatorServiceInterface
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

    public function getCalculationWithForm(Calculator $calculator, Form $form): array
    {
        $this->postConstruct($form);
        $calculation = null;
        try {
            if (in_array($calculator->getType(), $this->entityConstants)) {
                $fullMethodTypeName = $this->getFullMethodTypeName();
                $calculation = $this->$fullMethodTypeName();
            } else {
                throw new ArithmeticError('Missing calculation type');
            }
        } catch (ArithmeticError $exception) {
            $this->setErrorMessageByExceptionClass($exception);
        }

        return [$calculation, $this->form];
    }

    public function getPlusCalculation(): float
    {
        return $this->calculator->getFirstNumber() + $this->calculator->getSecondNumber();
    }

    public function getMinusCalculation(): float
    {
        return $this->calculator->getFirstNumber() - $this->calculator->getSecondNumber();
    }

    public function getMultiplicationCalculation(): float
    {
        return $this->calculator->getFirstNumber() * $this->calculator->getSecondNumber();
    }

    public function getDivisionCalculation(): float
    {
        return $this->calculator->getFirstNumber() / $this->calculator->getSecondNumber();
    }

    private function getFullMethodTypeName(): string
    {
        $entityConstantsKeys = array_flip($this->entityConstants);
        $pascalCaseTypeName = ucfirst(strtolower($entityConstantsKeys[$this->calculator->getType()]));
        return "get{$pascalCaseTypeName}Calculation";
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
