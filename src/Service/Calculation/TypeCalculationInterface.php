<?php

namespace App\Service\Calculation;

use App\Entity\Calculator;

interface TypeCalculationInterface
{
    public function get(Calculator $calculator): float;
}
