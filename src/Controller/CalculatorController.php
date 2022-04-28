<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for calculator actions
 */
class CalculatorController extends AbstractController
{
    /**
     * @Route("/calculator", name="calculator_index")
     */
    public function index(): void
    {
        var_dump('bravo');
        exit;
    }
}
