<?php

namespace App\Tests\Unit\Service;

use App\Entity\Calculator;
use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    public function testGetCalculationWithAllTypes(): void
    {
        foreach (self::getPreparedValues() as $value) {
            $calculator = $this->createMock(Calculator::class);
            $calculator->expects($this->once())
                       ->method('setFirstNumber');
            $calculator->expects($this->once())
                       ->method('setType');
            $calculator->expects($this->once())
                       ->method('setSecondNumber');
            $calculatorService = $this->createMock(CalculatorService::class);
            $calculatorService->expects($this->once())
                              ->method('getCalculation')
                              ->with($calculator)
                              ->willReturn($value['calculation']);
            $calculator->setFirstNumber($value['firstNumber']);
            $calculator->setType($value['type']);
            $calculator->setSecondNumber($value['secondNumber']);
            $calculation = $calculatorService->getCalculation($calculator);
            self::assertEquals($value['calculation'], $calculation);
        }
    }

    protected function getPreparedValues(): \Generator
    {
        yield [
            'firstNumber' => 1.1,
            'type' => Calculator::PLUS,
            'secondNumber' => -2.1,
            'calculation' => -1.0,
        ];

        yield [
            'firstNumber' => 1.1,
            'type' => Calculator::MINUS,
            'secondNumber' => -2.1,
            'calculation' => 3.2,
        ];

        yield [
            'firstNumber' => 1.0,
            'type' => Calculator::MULTIPLICATION,
            'secondNumber' => 2.0,
            'calculation' => 2.0,
        ];

        yield [
            'firstNumber' => 1.0,
            'type' => Calculator::DIVISION,
            'secondNumber' => 2.0,
            'calculation' => 0.5,
        ];
    }
}