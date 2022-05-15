<?php

namespace App\Form;

use Error;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;

class FormErrorHandler
{
    public function setErrorMessage(Form $form, Error $exception, ?string $inputName = null): void
    {
        if (is_string($inputName)) {
            $form->get($inputName)->addError(new FormError($exception->getMessage()));
        } else {
            $form->addError(new FormError($exception->getMessage()));
        }
    }
}
