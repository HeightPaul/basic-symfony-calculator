<?php

namespace App\Service\TypeCalculation;

class TypeCalculationFactory
{
    public static function create(array $entityConstants, string $name): TypeCalculationInterface
    {
        $entityConstantsKeys = array_flip($entityConstants);
        $typeName = ucfirst(strtolower($entityConstantsKeys[$name]));
        $className = sprintf('%s\%sCalculation', __NAMESPACE__, $typeName);
        return new $className();
    }
}
