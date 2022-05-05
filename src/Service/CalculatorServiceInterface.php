<?php

namespace App\Service;

/**
 * Calculation interface by types
 */
interface CalculatorServiceInterface
{
    public function getPlusCalculation(): float;
    public function getMinusCalculation(): float;
    public function getMultiplicationCalculation(): float;
    public function getDivisionCalculation(): float;
}
