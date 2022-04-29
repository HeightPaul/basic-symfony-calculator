<?php

namespace App\Controller;

use App\Entity\Calculator;
use App\Form\Type\CalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route('/calculator', name: 'app_calculator')]
    public function index(Request $request): Response
    {
        $calculator = new Calculator();
        $form = $this->createForm(CalculatorType::class, $calculator);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $calculator = $form->getData();

            return $this->redirectToRoute('calculator_success');
        }

        return $this->renderForm('Calculator/new.html.twig', [
            'form' => $form,
        ]);

        // $calculator->setFirstNumber(1);
        // $calculator->setType(Calculator::PLUS);
        // $calculator->setSecondNumber(2);

        $form = $this->createFormBuilder($calculator)->getForm();
        return $this->render('Calculator/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
