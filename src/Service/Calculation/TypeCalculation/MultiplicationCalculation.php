<?php

namespace App\Service\Calculation\TypeCalculation;

use App\Entity\Calculator;
use App\Service\Calculation\TypeCalculationInterface;

class MultiplicationCalculation implements TypeCalculationInterface
{
    public function get(Calculator $calculator): float
    {
        return $calculator->getFirstNumber() * $calculator->getSecondNumber();
    }
}
