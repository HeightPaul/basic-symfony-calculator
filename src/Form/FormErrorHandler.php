<?php

namespace App\Form;

use ArithmeticError;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;

class FormErrorHandler
{
    public function setErrorMessage(Form $form, ArithmeticError $exception): void
    {
        $this->setErrorMessageOnForm($form, $exception);
    }

    protected function setErrorMessageOnForm(Form $form, ArithmeticError $exception, ?string $inputName = null): void
    {
        if (is_string($inputName)) {
            $form->get($inputName)->addError(new FormError($exception->getMessage()));
        } else {
            $form->addError(new FormError($exception->getMessage()));
        }
    }
}
