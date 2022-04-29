<?php

namespace App\Entity;

class Calculator
{
    public const PLUS = '+';
    public const MINUS = '-';
    public const MULTIPLICATION = '*';
    public const DIVISION = '/';

    protected int $firstNumber;
    protected string $type;
    protected int $secondNumber;

    public function getFirstNumber(): int
    {
        return $this->firstNumber;
    }

    public function setFirstNumber(int $firstNumber): void
    {
        $this->firstNumber = $firstNumber;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getSecondNumber(): int
    {
        return $this->secondNumber;
    }

    public function setSecondNumber(int $secondNumber): void
    {
        $this->secondNumber = $secondNumber;
    }
}
