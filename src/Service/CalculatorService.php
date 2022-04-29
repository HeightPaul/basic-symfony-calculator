<?php

namespace App\Service;

use App\Entity\Calculator;

class CalculatorService
{
    public function getCalculation(Calculator $calculator): ?float
    {
        $calculation = null;
        switch ($calculator->getType()) {
            case Calculator::PLUS:
                $calculation = $calculator->getFirstNumber() + $calculator->getSecondNumber();
                break;
            case Calculator::MINUS:
                $calculation = $calculator->getFirstNumber() - $calculator->getSecondNumber();
                break;
            case Calculator::MULTIPLICATION:
                $calculation = $calculator->getFirstNumber() * $calculator->getSecondNumber();
                break;
            case Calculator::MULTIPLICATION:
                $calculation = $calculator->getFirstNumber() / $calculator->getSecondNumber();
                break;
        }
        return $calculation;
    }
}
