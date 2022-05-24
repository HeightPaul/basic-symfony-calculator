<?php

namespace App\Form\FormErrorHandler;

use App\Form\FormErrorHandler;
use ArithmeticError;
use DivisionByZeroError;
use Symfony\Component\Form\Form;

class CalculatorFormErrorHandler extends FormErrorHandler
{
    public function setErrorMessage(Form $form, ArithmeticError $exception): void
    {
        if ($exception instanceof DivisionByZeroError) {
            $this->setErrorMessageOnForm($form, $exception, 'secondNumber');
        } else {
            $this->setErrorMessageOnForm($form, $exception);
        }
    }
}
