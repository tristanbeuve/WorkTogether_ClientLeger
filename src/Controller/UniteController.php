<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UniteController extends AbstractController
{
    #[Route('/unite', name: 'app_unite')]
    public function index(): Response
    {
        return $this->render('unite/index.html.twig', [
            'controller_name' => 'UniteController',
        ]);
    }
}
