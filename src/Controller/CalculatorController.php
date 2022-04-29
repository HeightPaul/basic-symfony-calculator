<?php

namespace App\Controller;

use App\Entity\Calculator;
use App\Form\Type\CalculatorType;
use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CalculatorController extends AbstractController
{
    private CalculatorService $calculatorService;

    public function __construct(CalculatorService $calculatorService)
    {
        $this->calculatorService = $calculatorService;
    }

    public function index(Request $request, Calculator $calculator): Response
    {
        $form = $this->createForm(CalculatorType::class, $calculator);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $calculator = $form->getData();
            $view['calculation'] = $this->calculatorService->getCalculation($calculator);
        }
        $view['form'] = $form;

        return $this->renderForm('Calculator/index.html.twig', $view);
    }
}
