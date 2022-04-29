<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Calculator
{
    public const PLUS = '+';
    public const MINUS = '-';
    public const MULTIPLICATION = '*';
    public const DIVISION = '/';

    /**
     * @Assert\NotBlank
     * @Assert\Type("float")
     */
    private float $firstNumber;

    /**
     * @Assert\NotBlank
     */
    private string $type;

    /**
     * @Assert\NotBlank
     * @Assert\Type("float")
     */
    private float $secondNumber;

    public function getFirstNumber(): float
    {
        return $this->firstNumber;
    }

    public function setFirstNumber(float $firstNumber): void
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

    public function getSecondNumber(): float
    {
        return $this->secondNumber;
    }

    public function setSecondNumber(float $secondNumber): void
    {
        $this->secondNumber = $secondNumber;
    }
}
