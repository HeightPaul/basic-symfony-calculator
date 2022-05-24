<?php

namespace App\Service\TypeCalculation;

use App\Entity\Calculator;

interface TypeCalculationInterface
{
    public function get(Calculator $calculator): float;
}
