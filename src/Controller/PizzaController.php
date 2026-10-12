<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PizzaController extends AbstractController
{
    #[Route('/pizza', name: 'app_pizza')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $pizzas=$entityManager->getRepository(Pizza::class)->findAll();
       // dd($pizzas);
        return $this->render('pizza/index.html.twig', [
            'controller_name' => 'PizzaController',
            'pizzas'=>$pizzas
        ]);
    }
    #[Route('/pizza/new', name: 'app_pizza_new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $pizza=new Pizza();
        $form=$this->createForm(PizzaType::class,$pizza);

        return $this->render('pizza/new.html.twig',[
            'form'=>$form
        ]);
    }
}
