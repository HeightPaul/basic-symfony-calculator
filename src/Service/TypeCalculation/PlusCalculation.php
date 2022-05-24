<?php

namespace App\Service\TypeCalculation;

use App\Entity\Calculator;

class PlusCalculation implements TypeCalculationInterface
{
    public function get(Calculator $calculator): float
    {
        return $calculator->getFirstNumber() + $calculator->getSecondNumber();
    }
}
