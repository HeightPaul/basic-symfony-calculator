<?php

namespace App\Tests\Unit\Service;

use App\Entity\Calculator;
use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Form;

class CalculatorServiceTest extends TestCase
{
    public function testGetCalculationWithAllTypes(): void
    {
        foreach (self::getPreparedValues() as $value) {
            $form = $this->createMock(Form::class);
            $calculator = $this->createMock(Calculator::class);
            $calculator->expects($this->once())
                       ->method('setFirstNumber');
            $calculator->expects($this->once())
                       ->method('setType');
            $calculator->expects($this->once())
                       ->method('setSecondNumber');
            $calculatorService = $this->createMock(CalculatorService::class);
            $calculatorService->expects($this->once())
                              ->method('getCalculationWithForm')
                              ->with($calculator, $form)
                              ->willReturn([$value['calculation'], $form]);
            $calculator->setFirstNumber($value['firstNumber']);
            $calculator->setType($value['type']);
            $calculator->setSecondNumber($value['secondNumber']);
            [$calculation, $form] = $calculatorService->getCalculationWithForm($calculator, $form);
            self::assertEquals([$value['calculation'], $form], [$calculation, $form]);
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