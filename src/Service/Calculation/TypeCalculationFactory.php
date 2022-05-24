<?php

namespace App\Service\Calculation;

use App\Entity\Calculator;
use ArithmeticError;
use ReflectionClass;

class TypeCalculationFactory
{
    private array $entityConstants;

    public function __construct()
    {
        $this->entityConstants = (new ReflectionClass(Calculator::class))->getConstants();
    }

    public function create(string $name): TypeCalculationInterface
    {
        $this->isExistingType($name);

        $entityConstantsKeys = array_flip($this->entityConstants);
        $typeName = ucfirst(strtolower($entityConstantsKeys[$name]));
        $className = sprintf('%s\TypeCalculation\%sCalculation', __NAMESPACE__, $typeName);
        return new $className();
    }

    private function isExistingType(string $name): bool
    {
        if (in_array($name, $this->entityConstants)) {
            return true;
        }
        throw new ArithmeticError('Missing calculation type');
    }
}
